<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Notifications\NewWithdrawalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallet = Wallet::whereUserId(auth('api')->id())->where('active', 1)->first();
        return response()->json(['wallet' => $wallet], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function myWallet()
    {
        $wallets = Wallet::whereUserId(auth('api')->id())->get();
        return response()->json(['wallets' => $wallets], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function setWalletActive($id)
    {
        $checkWallet = Wallet::whereUserId(auth('api')->id())->where('active', 1)->first();
        if(!empty($checkWallet)) {
            $checkWallet->update(['active' => 0]);
        }

        $wallet = Wallet::find($id);
        if(!empty($wallet)) {
            $wallet->update(['active' => 1]);
            return response()->json(['wallet' => $wallet], 200);
        }
    }

    /**
     * Get daily withdrawal total
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDailyWithdrawnTotal()
    {
        try {
            $today = now()->startOfDay();
            $total = Withdrawal::where('user_id', auth('api')->id())
                ->where('created_at', '>=', $today)
                ->whereNotIn('status', ['rejected', 'cancelled'])
                ->sum('amount');

            return response()->json([
                'status' => true,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar total de saques diários',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestWithdrawal(Request $request)
    {
        try {
            // Buscar o nível de verificação do usuário
            $user = auth('api')->user();
            $verificationLevel = $user->verification?->level;

            if (!$verificationLevel) {
                return response()->json([
                    'status' => false,
                    'message' => 'Nível de verificação não encontrado'
                ], 400);
            }

            // Validar limite diário
            $today = now()->startOfDay();
            $dailyTotal = Withdrawal::where('user_id', $user->id)
                ->where('created_at', '>=', $today)
                ->whereNotIn('status', ['rejected', 'cancelled'])
                ->sum('amount');

            $remainingDaily = $verificationLevel->withdrawal_limit - $dailyTotal;

            if ($request->amount > $remainingDaily) {
                return response()->json([
                    'status' => false,
                    'message' => "Valor excede o limite diário disponível de {$remainingDaily}"
                ], 400);
            }

            // Validações do PIX
            if ($request->type === 'pix') {
                $rules = [
                    'amount' => ['required', 'numeric', 'min:20'],
                    'pix_type' => 'required',
                    'pix_key' => 'required',
                    'accept_terms' => 'required|accepted',
                ];

                if ($request->pix_type === 'document') {
                    $rules['pix_key'] = 'required|cpf_ou_cnpj';
                } elseif ($request->pix_type === 'email') {
                    $rules['pix_key'] = 'required|email';
                }

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
            }

            // Validar saldo
            if ($request->amount > $user->wallet->balance_withdrawal) {
                return response()->json([
                    'status' => false,
                    'message' => 'Saldo insuficiente para realizar o saque'
                ], 400);
            }

            // Criar o saque
            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'type' => $request->type,
                'pix_key' => $request->pix_key ?? null,
                'pix_type' => $request->pix_type ?? null,
                'currency' => $request->currency,
                'symbol' => $request->symbol,
                'status' => 0,
            ]);

            // Atualizar saldo
            $user->wallet->decrement('balance_withdrawal', $request->amount);

            // Notificar admins
            $admins = User::where('role_id', 0)->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewWithdrawalNotification($user->name, $request->amount));
            }

            return response()->json([
                'status' => true,
                'message' => 'Saque solicitado com sucesso'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao processar o saque',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
