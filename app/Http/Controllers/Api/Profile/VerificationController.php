<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\UserVerification;
use App\Models\VerificationLevel;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        
        // Verificar quais passos já foram completados
        $completedSteps = [];
        
        // Verificações básicas
        if ($user->email_verified_at) {
            $completedSteps[] = 'email_verified';
        }
        if ($user->phone_verified_at) {
            $completedSteps[] = 'phone_verified';
        }
        
        // Verificações de documentos
        $documents = $user->documents()
            ->whereIn('document_type', ['cpf', 'document', 'selfie'])
            ->where('status', 'approved')
            ->get();

        foreach ($documents as $document) {
            $completedSteps[] = $document->document_type . '_verified';
        }

        // Nova lógica para determinar o nível
        $level = 'bronze';
        $totalPoints = 0;
        
        // Requisitos para Prata: email E telefone verificados
        $hasSilverRequirements = $user->email_verified_at && $user->phone_verified_at;
        
        // Requisitos para Ouro: todos os documentos E requisitos da Prata
        $hasAllDocuments = $documents->whereIn('document_type', ['cpf', 'document', 'selfie'])->count() === 3;
        $hasGoldRequirements = $hasAllDocuments && $hasSilverRequirements;
        
        // Determinar nível atual baseado nos requisitos cumpridos
        if ($hasGoldRequirements) {
            $level = 'gold';
            $totalPoints = 300;
        } elseif ($hasSilverRequirements) {
            $level = 'silver';
            $totalPoints = 100;
        }

        // Buscar o nível apropriado
        $appropriateLevel = VerificationLevel::where('slug', $level)->first();

        // Carregar ou criar verificação do usuário
        $verification = $user->verification;
        if (!$verification) {
            $verification = UserVerification::create([
                'user_id' => $user->id,
                'verification_level_id' => $appropriateLevel->id,
                'points' => $totalPoints,
                'completed_steps' => $completedSteps
            ]);
        } else {
            // Atualizar verificação existente
            $verification->update([
                'verification_level_id' => $appropriateLevel->id,
                'points' => $totalPoints,
                'completed_steps' => $completedSteps
            ]);
        }

        // Carregar próximo nível se não estiver no nível máximo
        $nextLevel = null;
        if ($level !== 'gold') {
            $nextLevel = VerificationLevel::where('points_required', '>', $totalPoints)
                ->orderBy('points_required', 'asc')
                ->first();
        }

        return response()->json([
            'status' => true,
            'verification' => $verification->fresh(['level']),
            'current_level' => $appropriateLevel,
            'next_level' => $nextLevel,
            'all_levels' => VerificationLevel::orderBy('points_required', 'asc')->get(),
            'completed_steps' => $completedSteps,
            'debug_info' => [
                'documents' => $documents,
                'has_all_documents' => $hasAllDocuments,
                'has_silver_requirements' => $hasSilverRequirements,
                'has_gold_requirements' => $hasGoldRequirements,
                'level' => $level
            ]
        ]);
    }

    public function updatePoints(Request $request)
    {
        $user = auth('api')->user();
        $verification = $user->verification;

        if (!$verification) {
            return response()->json([
                'status' => false,
                'message' => 'Verificação não encontrada'
            ], 404);
        }

        try {
            $verification->addPoints($request->points);
            
            return response()->json([
                'status' => true,
                'message' => 'Pontos atualizados com sucesso',
                'verification' => $verification->fresh(['level'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar pontos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function completeStep(Request $request)
    {
        $user = auth('api')->user();
        $verification = $user->verification;

        if (!$verification) {
            return response()->json([
                'status' => false,
                'message' => 'Verificação não encontrada'
            ], 404);
        }

        try {
            $completedSteps = $verification->completed_steps ?? [];
            
            // Verificar se o passo já não foi completado
            if (!in_array($request->step, $completedSteps)) {
                $completedSteps[] = $request->step;
                $verification->completed_steps = array_unique($completedSteps);
                $verification->save();

                // Adicionar pontos baseado no passo completado
                $pointsMap = [
                    'email_verified' => 50,
                    'phone_verified' => 50,
                    'cpf_verified' => 100,
                    'document_verified' => 100,
                    'selfie_verified' => 100
                ];

                if (isset($pointsMap[$request->step])) {
                    $verification->addPoints($pointsMap[$request->step]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Passo completado com sucesso',
                'verification' => $verification->fresh(['level'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao completar passo: ' . $e->getMessage()
            ], 500);
        }
    }
} 