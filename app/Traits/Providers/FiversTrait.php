<?php

namespace App\Traits\Providers;

use App\Helpers\Core as Helper;
use App\Models\Game;
use App\Models\GamesKey;
use App\Models\GGRGamesFiver;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Missions\MissionTrait;
use Illuminate\Support\Facades\Http;
use App\Events\BalanceUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

trait FiversTrait
{
    use MissionTrait;

    /**
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @var string
     */
    protected static $agentCode;
    protected static $agentToken;
    protected static $agentSecretKey;
    protected static $apiEndpoint;

    /**
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return void
     */
    public static function getCredentials(): bool
    {
        $logFile = storage_path('logs/fivers-webhook.log');
        
        try {
            $setting = GamesKey::first();
            
            if (!$setting) {
                file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERRO: Nenhuma credencial encontrada no banco\n", FILE_APPEND);
                return false;
            }

            // Log das credenciais do banco
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - Credenciais do banco: " . json_encode([
                'agent_code' => $setting->agent_code,
                'agent_secret' => $setting->agent_secret_key
            ]) . "\n", FILE_APPEND);

            // Atribuição
            self::$agentCode = $setting->agent_code;
            self::$agentToken = $setting->agent_token;
            self::$agentSecretKey = $setting->agent_secret_key;
            self::$apiEndpoint = $setting->api_endpoint;

            // Verificação das credenciais atribuídas
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - Credenciais atribuídas: " . json_encode([
                'agent_code' => self::$agentCode,
                'agent_secret' => self::$agentSecretKey
            ]) . "\n", FILE_APPEND);

            return true;

        } catch (\Exception $e) {
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }

    public static function GetAllGames()
    {
        if(self::getCredentials()) {


        }
    }

    /**
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @param $rtp
     * @param $provider
     * @return void
     */
    public static function UpdateRTP($rtp, $provider)
    {
        if(self::getCredentials()) {
            $postArray = [
                "method"        => "control_rtp",
                "agent_code"    => self::$agentCode,
                "agent_token"   => self::$agentToken,
                "provider_code" => $provider,
                "user_code"     => auth('api')->id() . '',
                "rtp"           => $rtp
            ];

            $response = Http::get(self::$apiEndpoint, $postArray);

            if($response->successful()) {

            }
        }
    }

    /**
     * Create User
     * Metodo para criar novo usuário
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     *
     * @return bool
     */
    public static function createUser()
    {
        if(self::getCredentials()) {
            $postArray = [
                "method"        => "user_create",
                "agent_code"    => self::$agentCode,
                "agent_token"   => self::$agentToken,
                "user_code"     => auth('api')->id() . '',
            ];

            $response = Http::get(self::$apiEndpoint, $postArray);

            if($response->successful()) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Iniciar Jogo
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * Metodo responsavel para iniciar o jogo
     */
    public static function GameLaunchFivers($provider_code, $game_code, $lang, $userId)
    {
        Log::channel('fivers')->info('Iniciando GameLaunchFivers', [
            'provider_code' => $provider_code,
            'game_code' => $game_code,
            'lang' => $lang,
            'userId' => $userId,
            'timestamp' => now()
        ]);

        if (!self::getCredentials()) {
            Log::channel('fivers')->error('Falha ao obter credenciais para GameLaunchFivers');
            return ['error' => 'Credenciais inválidas'];
        }

        try {
            $wallet = Wallet::where('user_id', $userId)
                ->where('active', 1)
                ->first();

            Log::channel('fivers')->info('Dados da carteira para GameLaunchFivers', [
                'wallet_id' => $wallet->id ?? null,
                'balance' => $wallet->total_balance ?? 0,
                'userId' => $userId
            ]);

            $postArray = [
                "agentToken" => self::$agentToken,
                "secretKey" => self::$agentSecretKey,
                "user_code" => $userId.'',
                "game_code" => $game_code,
                "user_balance" => $wallet->total_balance ?? 0,
                "lang" => $lang
            ];

            Log::channel('fivers')->info('Enviando requisição para Fivers', [
                'endpoint' => rtrim(self::$apiEndpoint, '/') . '/game_launch',
                'request' => $postArray
            ]);

            $response = Http::post(rtrim(self::$apiEndpoint, '/') . '/game_launch', $postArray);
            
            Log::channel('fivers')->info('Resposta do servidor Fivers', [
                'status_code' => $response->status(),
                'response_body' => $response->json()
            ]);

            return $response->json();

        } catch (\Exception $e) {
            Log::channel('fivers')->error('Erro em GameLaunchFivers', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'userId' => $userId,
                'game_code' => $game_code
            ]);
            return ['error' => 'Erro ao iniciar o jogo'];
        }
    }

    /**
     * Get FIvers Balance
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return false|void
     */
    public static function getFiversUserDetail()
    {
        if(self::getCredentials()) {
            $dataArray = [
                "method"        => "call_players",
                "agent_code"    => self::$agentCode,
                "agent_token"   => self::$agentToken,
            ];

            $response = Http::get(self::$apiEndpoint, $dataArray);

            if($response->successful()) {
                $data = $response->json();

                dd($data);
            }else{
                return false;
            }
        }

    }

    /**
     * Get FIvers Balance
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @param $provider_code
     * @param $game_code
     * @param $lang
     * @param $userId
     * @return false|void
     */
    public static function getFiversBalance()
    {
        if(self::getCredentials()) {
            $dataArray = [
                "method"        => "money_info",
                "agent_code"    => self::$agentCode,
                "agent_token"   => self::$agentToken,
            ];

            $response = Http::get(self::$apiEndpoint, $dataArray);

            if($response->successful()) {
                $data = $response->json();

                return $data['agent']['balance'] ?? 0;
            }else{
                return false;
            }
        }

    }


    /**
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function GetBalanceInfo($request)
    {
        $wallet = Wallet::where('user_id', $request->user_code)->where('active', 1)->first();
        if(!empty($wallet)) {
            return response()->json([
                'status' => 1,
                'user_balance' => $wallet->total_balance
            ]);
        }

        return response()->json([
            'status' => 0,
            'user_balance' => 0,
            'msg' => "INSUFFICIENT_USER_FUNDS"
        ]);
    }

    /**
     * Set Transactions
     *
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function SetTransaction($request)
    {
        $data = $request->all();
        $wallet = Wallet::where('user_id', $request->user_code)->where('active', 1)->first();

        if(!empty($wallet) && isset($data['slot'])) {
            if($data['game_type'] == 'slot' && isset($data['slot'])) {
                $game = Game::where('game_code', $data['slot']['game_code'])->first();

                /// verificar se usuário tem desafio ativo
                self::CheckMissionExist($request->user_code, $game, 'fivers');
                $transaction = self::PrepareTransactions(
                    $wallet,
                    $request->user_code,
                    $data['slot']['txn_id'],
                    $data['slot']['bet_money'],
                    $data['slot']['win_money'],
                    $data['slot']['game_code'],
                    $data['slot']['provider_code']
                );

                if($transaction) {
                    $wallet = Wallet::where('user_id', $request->user_code)->where('active', 1)->first();
                    
                    // Broadcast balance update via WebSocket
                    broadcast(new BalanceUpdated($request->user_code, $wallet->total_balance))->toOthers();

                    return response()->json([
                        'status' => 1,
                        'user_balance' => $wallet->total_balance
                    ]);
                }
            }

            if($data['game_type'] == 'live' &&  isset($data['live'])) {
                $game = Game::where('game_code', $data['live']['game_code'])->first();

                /// verificar se usuário tem desafio ativo
                self::CheckMissionExist($request->user_code, $game, 'fivers');
                $transaction =  self::PrepareTransactions(
                    $wallet,
                    $request->user_code,
                    $data['live']['txn_id'],
                    $data['live']['bet_money'],
                    $data['live']['win_money'],
                    $data['live']['game_code'],
                    $data['live']['provider_code']
                );

                if($transaction) {

                }else{
                    return response()->json([
                        'status' => 0,
                        'msg' => 'INSUFFICIENT_USER_FUNDS'
                    ]);
                }
            }
        }

        if(!empty($wallet) && isset($data['msg']) && $data['msg'] == 'Money change during the game.') {
            return response()->json([
                'status' => 1,
                'user_balance' => $wallet->total_balance
            ]);
        }

        return response()->json([
            'status' => 0,
            'msg' => 'INSUFFICIENT_USER_FUNDS'
        ]);
    }

    /**
     * Prepare Transaction
     * Metodo responsavel por preparar a transação
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     *
     * @param $wallet
     * @param $userCode 
     * @param $txnId
     * @param $betMoney
     * @param $winMoney
     * @param $gameCode
     * @return bool
     */
    private static function PrepareTransactions($wallet, $userCode, $txnId, $betMoney, $winMoney, $gameCode, $providerCode)
    {
        Log::channel('fivers')->info('Iniciando PrepareTransactions', [
            'user_code' => $userCode,
            'txn_id' => $txnId,
            'bet_amount' => $betMoney,
            'win_amount' => $winMoney,
            'game_code' => $gameCode,
            'provider_code' => $providerCode
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($userCode);
            if (!$user) {
                Log::channel('fivers')->error('Usuário não encontrado', ['user_code' => $userCode]);
                throw new \Exception('User not found');
            }

            $bet = floatval($betMoney);
            $win = floatval($winMoney);

            Log::channel('fivers')->info('Saldos antes da transação', [
                'total_balance' => $wallet->total_balance,
                'balance' => $wallet->balance,
                'balance_bonus' => $wallet->balance_bonus,
                'balance_withdrawal' => $wallet->balance_withdrawal
            ]);

            // Verifica saldo
            if ($wallet->total_balance < $bet) {
                Log::channel('fivers')->warning('Saldo insuficiente', [
                    'required' => $bet,
                    'available' => $wallet->total_balance
                ]);
                throw new \Exception('Insufficient funds');
            }

            // Processa transações
            if ($bet > 0) {
                Log::channel('fivers')->info('Processando aposta', [
                    'bet_amount' => $bet,
                    'txn_id' => $txnId
                ]);

                // Deduz o saldo
                if ($wallet->balance_bonus >= $bet) {
                    $wallet->decrement('balance_bonus', $bet);
                    $changeBonus = 'balance_bonus';
                } elseif ($wallet->balance >= $bet) {
                    $wallet->decrement('balance', $bet);
                    $changeBonus = 'balance';
                } elseif ($wallet->balance_withdrawal >= $bet) {
                    $wallet->decrement('balance_withdrawal', $bet);
                    $changeBonus = 'balance_withdrawal';
                }

                // Registra transação de aposta
                self::CreateTransactions($userCode, time(), $txnId, 'bet', $changeBonus, $bet, 'fivers', $gameCode, $gameCode);
            }

            // Processa ganhos
            if ($win > 0) {
                Log::channel('fivers')->info('Processando ganho', [
                    'win_amount' => $win,
                    'txn_id' => $txnId
                ]);
                
                $wallet->increment('balance', $win);
                self::CreateTransactions($userCode, time(), $txnId . '_win', 'win', 'balance', $win, 'fivers', $gameCode, $gameCode);
            }

            // Registra GGR
            GGRGamesFiver::create([
                'user_id' => $userCode,
                'provider' => $providerCode,
                'game' => $gameCode,
                'balance_bet' => $bet,
                'balance_win' => $win,
                'currency' => $wallet->currency
            ]);

            $wallet->refresh();
            Log::channel('fivers')->info('Saldos após a transação', [
                'total_balance' => $wallet->total_balance,
                'balance' => $wallet->balance,
                'balance_bonus' => $wallet->balance_bonus,
                'balance_withdrawal' => $wallet->balance_withdrawal
            ]);

            DB::commit();
            
            Log::channel('fivers')->info('Transação completada com sucesso', [
                'txn_id' => $txnId,
                'user_code' => $userCode
            ]);

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('fivers')->error('Erro na transação', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_code' => $userCode,
                'txn_id' => $txnId
            ]);
            return false;
        }
    }

    /**
     * @param $request
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return \Illuminate\Http\JsonResponse|null
     */
    public static function WebhooksFivers($request)
    {
        Log::channel('fivers')->info('Recebendo webhook Fivers', [
            'method' => $request->method(),
            'params' => $request->all()
        ]);

        try {
            // Validação das credenciais primeiro
            if (!self::getCredentials()) {
                return response()->json([
                    'msg' => 'INVALID_CREDENTIALS',
                    'balance' => 0
                ]);
            }

            // Busca a carteira uma única vez
            $wallet = Wallet::where('user_id', $request->user_code)
                           ->where('active', 1)
                           ->lockForUpdate()
                           ->first();

            if (!$wallet) {
                return response()->json([
                    'msg' => 'INVALID_USER',
                    'balance' => 0
                ]);
            }

            if ($request->type === 'BALANCE') {
                return response()->json([
                    'msg' => 'SUCCESS',
                    'balance' => $wallet->total_balance
                ]);
            }

            if ($request->type === 'WinBet' && isset($request->slot)) {
                DB::beginTransaction();
                try {
                    // Verifica transação duplicada
                    $existingTx = Order::where('transaction_id', $request->slot['txn_id'])->first();
                    if ($existingTx) {
                        return response()->json([
                            'msg' => 'SUCCESS',
                            'balance' => $wallet->total_balance
                        ]);
                    }

                    $transaction = self::PrepareTransactions(
                        $wallet,
                        $request->user_code,
                        $request->slot['txn_id'],
                        $request->slot['bet'],
                        $request->slot['win'],
                        $request->slot['game_code'],
                        $request->slot['provider_code']
                    );

                    if (!$transaction) {
                        throw new \Exception('INSUFFICIENT_FUNDS');
                    }

                    $wallet->refresh();
                    DB::commit();

                    broadcast(new BalanceUpdated($request->user_code, $wallet->total_balance))->toOthers();

                    return response()->json([
                        'msg' => 'SUCCESS',
                        'balance' => $wallet->total_balance
                    ]);

                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::channel('fivers')->error('Erro na transação', [
                        'error' => $e->getMessage(),
                        'user_code' => $request->user_code
                    ]);

                    return response()->json([
                        'msg' => 'INSUFFICIENT_FUNDS',
                        'balance' => $wallet->total_balance
                    ]);
                }
            }

            return response()->json([
                'msg' => 'INVALID_REQUEST_TYPE',
                'balance' => $wallet->total_balance
            ]);

        } catch (\Exception $e) {
            Log::channel('fivers')->error('Erro geral', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'msg' => 'INTERNAL_ERROR',
                'balance' => 0
            ]);
        }
    }

    // Adicionar novo método para gerenciar sessão
    private static function updateGameSession($request)
    {
        try {
            $wallet = Wallet::where('user_id', $request->user_code)
                           ->where('active', 1)
                           ->first();

            if (!$wallet) {
                return response()->json(['status' => 0, 'msg' => 'INVALID_USER']);
            }

            // Atualiza a sessão do jogo
            Cache::put(
                'game_session_' . $request->user_code,
                [
                    'session_id' => $request->session_id,
                    'game_code' => $request->game_code,
                    'last_activity' => now()
                ],
                now()->addHours(4)
            );

            return response()->json([
                'status' => 1,
                'user_balance' => $wallet->total_balance
            ]);

        } catch (\Exception $e) {
            Log::error('Fivers: Erro ao atualizar sessão', [
                'error' => $e->getMessage(),
                'user_code' => $request->user_code
            ]);
            return response()->json(['status' => 0, 'msg' => 'SESSION_UPDATE_ERROR']);
        }
    }

    /**
     * Create Transactions
     * Metodo para criar uma transação
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     *
     * @return false
     */
    private static function CreateTransactions($playerId, $betReferenceNum, $transactionID, $type, $changeBonus, $amount, $providers, $game, $pn): Order
    {
        $order = Order::create([
            'user_id'       => $playerId,
            'session_id'    => $betReferenceNum,
            'transaction_id'=> $transactionID,
            'type'          => $type,
            'type_money'    => $changeBonus,
            'amount'        => $amount,
            'providers'     => $providers,
            'game'          => $game,
            'game_uuid'     => $pn,
            'round_id'      => 1,
        ]);

        return $order;
    }
}


?>
