<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // max 5MB
            'document_type' => 'required|string|in:cpf,document,selfie',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            $user = auth('api')->user();
            
            // Verifica se já existe um documento do mesmo tipo
            $existingDocument = Document::where('user_id', $user->id)
                                      ->where('document_type', $request->document_type)
                                      ->first();

            // Se existir, deleta o arquivo antigo
            if ($existingDocument) {
                Storage::disk('public')->delete($existingDocument->path);
                $existingDocument->delete();
            }

            // Cria o diretório para o usuário se não existir
            $userDirectory = "documents/{$user->id}";
            if (!Storage::disk(name: 'public')->exists($userDirectory)) {
                Storage::disk('public')->makeDirectory($userDirectory);
            }

            // Gera um nome único para o arquivo
            $extension = $request->file('document')->getClientOriginalExtension();
            $fileName = $request->document_type . '_' . time() . '.' . $extension;
            
            // Salva o arquivo no diretório do usuário
            $path = $request->file('document')->storeAs(
                $userDirectory,
                $fileName,
                'public'
            );

            // Cria o novo registro
            $document = Document::create([
                'user_id' => $user->id,
                'document_type' => $request->document_type,
                'path' => $path,
                'status' => 'pending'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Documento enviado com sucesso.',
                'document' => $document
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao salvar documento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $user = auth('api')->user();
            
            $documents = Document::where('user_id', $user->id)
                               ->get()
                               ->map(function ($document) {
                                   $document->file_url = Storage::disk('public')->url($document->path);
                                   $document->makeVisible(['rejection_reason']);
                                   return $document;
                               });

            return response()->json([
                'status' => true,
                'documents' => $documents
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar documentos: ' . $e->getMessage()
            ], 500);
        }
    }
}
