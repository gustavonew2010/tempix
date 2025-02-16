<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Services\CPFService;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalEarnings = Order::where('user_id', auth('api')->id())
                              ->where('type', 'win')
                              ->sum('amount');
        $totalBets = Order::where('user_id', auth('api')->id())
                          ->where('type', 'bet')
                          ->count();
        $sumBets = Order::where('user_id', auth('api')->id())
                        ->where('type', 'bet')
                        ->sum('amount');

        $user = auth('api')->user()->fresh()->makeVisible([
            'cpf',
            'mother_name',
            'birth_date',
            'cep',
            'street',
            'neighborhood',
            'city',
            'state',
            'number',
            'complement',
            'display_name'
        ]);
        
        $userArray = $user->toArray();
        $userArray['fullName']   = $userArray['name'] ?? null;
        $userArray['motherName'] = $userArray['mother_name'] ?? null;
        $userArray['birthDate']  = $userArray['birth_date'] ?? null;
        $userArray['displayName'] = $userArray['display_name'] ?? $userArray['name'];

        return response()->json([
            'status'         => true,
            'user'           => $userArray,
            'totalEarnings'  => \Helper::amountFormatDecimal($totalEarnings),
            'totalBets'      => \Helper::amountFormatDecimal($totalBets),
            'sumBets'        => $sumBets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateName(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if(auth('api')->user()->update(['name' => $request->name])) {
            return response()->json(['status' => true, 'message' => trans('Name was updated successfully')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadAvatar(Request $request)
    {
        $rules = [
            'avatar' => ['required','image','mimes:jpg,png,jpeg'],
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $avatar = \Helper::upload($request->avatar)['path'];
        if(auth('api')->user()->update(['avatar' => $avatar])) {
            return response()->json(['status' => true, 'message' => trans('Avatar has been updated successfully')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLanguage(Request $request)
    {
        if(auth('api')->check()) {
            $user = auth('api')->user();

            $user->language = $request->input('language');
            $user->save();

            return response()->json(['message' => 'Idioma atualizado com sucesso']);
        }
        return response()->json(['message' => 'Idioma atualizado com sucesso, mas com dados salvo na sessão, faça login para salvar em seu perfil']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLanguage(Request $request)
    {
        $browserLanguages = $request->getLanguages();

        $preferredLanguage = $browserLanguages[0] ?? 'en';
        if(auth('api')->check()) {
            return response()->json(['language' => auth('api')->user()->language]);
        }

        return response()->json(['language' => $preferredLanguage]);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:5120' // 5MB
        ]);

        try {
            $user = auth('api')->user();

            // Remove avatar antigo se existir
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Salva o novo avatar
            $path = $request->file('avatar')->store('avatars/' . $user->id, 'public');
            
            // Atualiza o usuário
            $user->avatar = Storage::url($path);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Avatar atualizado com sucesso',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar avatar: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePersonalData(Request $request)
    {
        $rules = [
            'fullName'     => 'required|string|max:255',
            'cpf'          => 'required|string|max:14',
            'motherName'   => 'required|string|max:255',
            'birthDate'    => 'required|date',
            'cep'          => 'required|string|max:10',
            'street'       => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'state'        => 'required|string|max:50',
            'number'       => 'required|string|max:50',
            'complement'   => 'nullable|string|max:255',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = auth('api')->user();

        $user->update([
            'name'         => $request->fullName,
            'cpf'          => $request->cpf,
            'mother_name'  => $request->motherName,
            'birth_date'   => $request->birthDate,
            'cep'          => $request->cep,
            'street'       => $request->street,
            'neighborhood' => $request->neighborhood,
            'city'         => $request->city,
            'state'        => $request->state,
            'number'       => $request->number,
            'complement'   => $request->complement,
        ]);

        // Atualiza a instância para retornar todos os dados salvos
        $user = $user->fresh();

        return response()->json([
            'status'  => true,
            'message' => 'Dados pessoais atualizados com sucesso.',
            'user'    => $user,
        ]);
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',      // deve conter pelo menos 1 letra maiúscula
                'regex:/[a-z]/',      // deve conter pelo menos 1 letra minúscula
                'regex:/[0-9]/',      // deve conter pelo menos 1 número
                'regex:/[!@#$%^&*]/', // deve conter pelo menos 1 caractere especial
            ],
            'confirm_password' => 'required|same:new_password',
        ];

        $messages = [
            'new_password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.',
            'confirm_password.same' => 'A confirmação de senha não corresponde à nova senha.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = auth('api')->user();

        // Verifica se a senha atual está correta usando Hash::check
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        // Atualiza a senha - não precisa fazer Hash::make aqui porque o modelo User já faz isso
        $user->password = $request->new_password;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Senha alterada com sucesso'
        ]);
    }

    public function update(Request $request)
    {
        try {
            $user = auth('api')->user();
            
            $user->update([
                'display_name' => $request->displayName ?? $user->name,
                'phone' => $request->phone
            ]);

            // Buscar o usuário atualizado com todos os campos necessários
            $user = $user->fresh()->makeVisible([
                'cpf',
                'mother_name',
                'birth_date',
                'cep',
                'street',
                'neighborhood',
                'city',
                'state',
                'number',
                'complement',
                'display_name'  // Garantir que display_name está visível
            ]);
            
            $userArray = $user->toArray();
            $userArray['fullName']   = $userArray['name'] ?? null;
            $userArray['motherName'] = $userArray['mother_name'] ?? null;
            $userArray['birthDate']  = $userArray['birth_date'] ?? null;
            $userArray['displayName'] = $userArray['display_name'] ?? $userArray['name']; // Adicionar displayName

            return response()->json([
                'status' => true,
                'message' => 'Dados atualizados com sucesso',
                'user' => $userArray
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar dados: ' . $e->getMessage()
            ], 500);
        }
    }

    public function searchCPF(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2dhdGV3YXkuYXBpYnJhc2lsLmlvL2FwaS92Mi9hdXRoL3JlZ2lzdGVyIiwiaWF0IjoxNzM5MDM3MDM3LCJleHAiOjE3NzA1NzMwMzcsIm5iZiI6MTczOTAzNzAzNywianRpIjoiY3JqUTVqTjZSQTJBNU1sOSIsInN1YiI6IjEzNjUyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.qJl8o3u6olZV5-y7RBrvn-iUNXLs3POHndCeAOPXRwA',
                'DeviceToken' => '781599ed-e997-4ef5-b7b9-f6fcf6c03143',
                'Content-Type' => 'application/json'
            ])->post('https://gateway.apibrasil.io/api/v2/dados/cpf', [
                'cpf' => $request->query('cpf')
            ]);

            $data = $response->json();

            if ($data['error'] ?? false) {
                return response()->json([
                    'error' => true,
                    'message' => $data['response']['message'] ?? 'Erro ao consultar CPF'
                ], 400);
            }

            if (isset($data['response']['content']['nome']['conteudo'])) {
                $pessoa = $data['response']['content']['nome']['conteudo'];
                return response()->json([
                    'error' => false,
                    'data' => [
                        'nome' => $pessoa['nome'],
                        'mae' => $pessoa['mae'],
                        'data_nascimento' => $pessoa['data_nascimento']
                    ]
                ]);
            }

            return response()->json([
                'error' => true,
                'message' => 'Não foi possível obter os dados do CPF'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Erro ao consultar CPF'
            ], 500);
        }
    }
}
