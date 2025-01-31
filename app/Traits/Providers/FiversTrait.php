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
        try {
            \Log::info('Iniciando GameLaunchFivers', [
                'provider_code' => $provider_code,
                'game_code' => $game_code,
                'lang' => $lang,
                'userId' => $userId
            ]);

            $wallet = Wallet::where('user_id', $userId)->first();
            
            \Log::info('Dados da carteira', [
                'wallet_id' => $wallet->id,
                'balance' => $wallet->total_balance
            ]);

            $endpoint = 'https://api.playfivers.com/api/v2/game_launch';
            
            $request = [
                'agentToken' => config('services.fivers.agent_token'),
                'secretKey' => config('services.fivers.secret_key'),
                'user_code' => (string)$userId,
                'game_code' => $game_code,
                'user_balance' => $wallet->total_balance,
                'lang' => $lang
            ];

            \Log::info('Enviando requisição para Fivers', [
                'endpoint' => $endpoint,
                'request' => array_merge($request, ['secretKey' => '****'])
            ]);

            $response = Http::post($endpoint, $request);
            
            if ($response->status() === 403) {
                \Log::error('Erro de autenticação na API Fivers', [
                    'status' => $response->status(),
                    'body' => $response->json()
                ]);
                return 'Erro de autenticação com o provedor. Por favor, contate o suporte.';
            }

            if (!$response->successful()) {
                \Log::error('Erro na resposta da API Fivers', [
                    'status' => $response->status(),
                    'body' => $response->json()
                ]);
                return 'Erro ao iniciar o jogo. Por favor, tente novamente.';
            }

            $responseData = $response->json();
            
            if (!isset($responseData['launch_url'])) {
                \Log::error('Resposta da API Fivers sem launch_url', [
                    'response' => $responseData
                ]);
                return 'URL de lançamento não encontrada';
            }

            return [
                'launch_url' => $responseData['launch_url']
            ];

        } catch (\Exception $e) {
            \Log::error('Exceção no GameLaunchFivers', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'Erro interno ao iniciar o jogo. Por favor, tente novamente.';
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
     * @return \Illuminate\Http\JsonResponse|void
     */
    private static function PrepareTransactions($wallet, $userCode, $txnId, $betMoney, $winMoney, $gameCode, $providerCode)
    {
        $user = User::find($wallet->user_id);

        if(!empty($user)) {
            $typeAction  = 'bet';
            $changeBonus = 'balance';
            $bet = floatval($betMoney);
            $win = floatval($winMoney);
            $result = $bet - $win;

            /// deduz o saldo apostado
            if($wallet->balance_bonus > $bet) {
                $wallet->decrement('balance_bonus', $bet); /// retira do bonus
                $changeBonus = 'balance_bonus'; /// define o tipo de transação
            }elseif($wallet->balance >= $bet) {
                $wallet->decrement('balance', $bet); /// retira do saldo depositado
                $changeBonus = 'balance'; /// define o tipo de transação
            }elseif($wallet->balance_withdrawal >= $bet) {
                $wallet->decrement('balance_withdrawal', $bet); /// retira do saldo liberado pra saque
                $changeBonus = 'balance_withdrawal'; /// define o tipo de transação 
            }else{
                return response()->json([
                    'status' => 0,
                    'msg' => 'INSUFFICIENT_USER_FUNDS'
                ]);
            }

            if($win > 0) {
                $typeAction = 'win';
                $transaction = self::CreateTransactions($userCode, time(), $txnId, $typeAction, $changeBonus, $win, 'fivers', $gameCode, $gameCode);

                if(!empty($transaction)) {
                    /// salvar transação GGR
                    GGRGamesFiver::create([
                        'user_id' => $userCode,
                        'provider' => $providerCode,
                        'game' => $gameCode,
                        'balance_bet' => $betMoney,
                        'balance_win' => $winMoney,
                        'currency' => $wallet->currency
                    ]);

                    /// pagar afiliado
                    Helper::generateGameHistory($user->id, $typeAction, $winMoney, $bet, $changeBonus, $txnId);

                    // Broadcast balance update via WebSocket
                    broadcast(new BalanceUpdated($userCode, $wallet->total_balance))->toOthers();

                    return response()->json([
                        'status' => 1,
                        'user_balance' => $wallet->total_balance
                    ]);
                }
            }

            /// criar uma transação
            $checkTransaction = Order::where('transaction_id', $txnId)->first();
            if(empty($checkTransaction)) {
                $checkTransaction = self::CreateTransactions($userCode, time(), $txnId, $typeAction, $changeBonus, $bet, 'fivers', $gameCode, $gameCode);
            }

            /// salvar transação GGR
            GGRGamesFiver::create([
                'user_id' => $userCode,
                'provider' => $providerCode,
                'game' => $gameCode,
                'balance_bet' => $bet,
                'balance_win' => 0,
                'currency' => $wallet->currency
            ]);

            Helper::generateGameHistory($user->id, $typeAction, $winMoney, $bet, $changeBonus, $checkTransaction->transaction_id);

            // Broadcast balance update via WebSocket
            broadcast(new BalanceUpdated($userCode, $wallet->total_balance))->toOthers();

            return response()->json([
                'status' => 1,
                'user_balance' => $wallet->total_balance
            ]);
        }

        return response()->json([
            'status' => 0,
            'msg' => 'USER_NOT_FOUND'
        ]);
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
            $logFile = storage_path('logs/fivers-webhook.log');
            
            // Log inicial da requisição
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - Nova requisição recebida\n", FILE_APPEND);
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - Dados: " . json_encode($request->all()) . "\n", FILE_APPEND);

            if($request->type === 'WinBet') {
                $credentialsLoaded = self::getCredentials();
                
                file_put_contents($logFile, date('Y-m-d H:i:s') . " - getCredentials retornou: " . ($credentialsLoaded ? 'true' : 'false') . "\n", FILE_APPEND);

                if(!$credentialsLoaded) {
                    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Falha ao carregar credenciais\n", FILE_APPEND);
                    return response()->json(['msg' => 'INVALID_CREDENTIALS', 'balance' => 0]);
                }

                // Comparação das credenciais
                $isValid = ($request->agent_code === self::$agentCode && 
                           $request->agent_secret === self::$agentSecretKey);

                file_put_contents($logFile, date('Y-m-d H:i:s') . " - Validação de credenciais: " . json_encode([
                    'recebido' => [
                        'agent_code' => $request->agent_code,
                        'agent_secret' => $request->agent_secret
                    ],
                    'esperado' => [
                        'agent_code' => self::$agentCode,
                        'agent_secret' => self::$agentSecretKey
                    ],
                    'is_valid' => $isValid
                ]) . "\n", FILE_APPEND);

                if(!$isValid) {
                    return response()->json(['msg' => 'INVALID_CREDENTIALS', 'balance' => 0]);
                }

                // Processa a transação
                $wallet = Wallet::where('user_id', $request->user_code)
                              ->where('active', 1)
                              ->first();

                if(empty($wallet)) {
                    return response()->json([
                        'msg' => 'INVALID_USER',
                        'balance' => 0
                    ]);
                }

                // Verifica se tem saldo suficiente para a aposta
                if(isset($request->slot) && $request->slot['bet'] > $wallet->total_balance) {
                    return response()->json([
                        'msg' => 'INSUFFICIENT_USER_FUNDS',
                        'balance' => $wallet->total_balance
                    ]);
                }

                // Processa a transação
                if(isset($request->slot)) {
                    $transaction = self::PrepareTransactions(
                        $wallet,
                        $request->user_code,
                        $request->slot['txn_id'],
                        $request->slot['bet'],
                        $request->slot['win'],
                        $request->slot['game_code'],
                        $request->slot['provider_code']
                    );

                    // Atualiza o saldo após a transação
                    $wallet->refresh();

                    return response()->json([
                        'msg' => '',
                        'balance' => $wallet->total_balance
                    ]);
                }
            }

            return response()->json([
                'msg' => 'INVALID_REQUEST',
                'balance' => 0
            ]);

        } catch (\Exception $e) {
            Log::channel('fivers')->error('Erro no webhook Fivers', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
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
