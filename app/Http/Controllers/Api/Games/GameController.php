<?php

namespace App\Http\Controllers\Api\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameFavorite;
use App\Models\GameLike;
use App\Models\GamesKey;
use App\Models\Gateway;
use App\Models\Provider;
use App\Models\Wallet;
use App\Traits\Providers\EvergameTrait;
use App\Traits\Providers\FiversTrait;
use App\Traits\Providers\Games2ApiTrait;
use App\Traits\Providers\KaGamingTrait;
use App\Traits\Providers\PlayGamingTrait;
use App\Traits\Providers\PlayIGamingTrait;
use App\Traits\Providers\SalsaGamesTrait;
use App\Traits\Providers\VeniXTrait;
use App\Traits\Providers\VibraTrait;
use App\Traits\Providers\PlayConnectTrait;
use App\Traits\Providers\ExpfyTrait;
use App\Traits\Providers\WorldSlotTrait;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\Core as Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    use KaGamingTrait,
        PlayConnectTrait,
        FiversTrait,
        VibraTrait,
        SalsaGamesTrait,
        WorldSlotTrait,
        Games2ApiTrait,
        VeniXTrait,
        EvergameTrait,
  		ExpfyTrait,
        PlayGamingTrait,
        PlayIGamingTrait;

    /**
     * @dev victormsalatiel
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::with(['provider', 'categories'])
            ->where('status', 1)
            ->whereHas('provider', function($q) {
                $q->where('distribution', 'fivers');
            });

        // Filtro por categoria
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filtro por provedor usando code
        if ($request->has('provider') && $request->provider) {
            $query->whereHas('provider', function($q) use ($request) {
                $q->where('code', $request->provider);
            });
        }

        // Busca por nome
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('game_name', 'like', "%{$search}%")
                  ->orWhere('game_id', 'like', "%{$search}%");
            });
        }

        // Log da query antes da execução
        \Log::info('SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'provider_id' => $request->provider,
            'category' => $request->category,
            'search' => $request->search
        ]);

        // Ordenação por visualizações
        $query->orderBy('views', 'desc');

        // Paginação
        $perPage = $request->get('per_page', 12);
        $games = $query->paginate($perPage);

        // Log dos resultados
        \Log::info('Query Results:', [
            'total_games' => $games->total(),
            'current_page' => $games->currentPage(),
            'per_page' => $games->perPage()
        ]);

        return response()->json([
            'data' => $games->items(),
            'total' => $games->total(),
            'current_page' => $games->currentPage(),
            'per_page' => $games->perPage(),
            'last_page' => $games->lastPage(),
            'has_more_pages' => $games->hasMorePages()
        ]);
    }

    /**
     * @dev victormsalatiel
     * @return \Illuminate\Http\JsonResponse
     */
    public function featured()
    {
        $featured_games = Game::with(['provider'])
                    ->where('is_featured', 1)
                    ->where('status', 1)
                    ->get();

        return response()->json(['featured_games' => $featured_games]);
    }

    /**
     * Source Provider
     *
     * @dev victormsalatiel
     * @param Request $request
     * @param $token
     * @param $action
     * @return \Illuminate\Http\JsonResponse|void
     */ 
    public function sourceProvider(Request $request, $token, $action)
    {
        $tokenOpen = Helper::DecToken($token); 
        $validEndpoints = ['session', 'icons', 'spin', 'freenum'];

        if (in_array($action, $validEndpoints)) {
            if(isset($tokenOpen['status']) && $tokenOpen['status'])
            {
                $game = Game::whereStatus(1)->where('game_code', $tokenOpen['game'])->first();
                if(!empty($game)) {
                    $controller = Helper::createController($game->game_code);

                    switch ($action) {
                        case 'session':
                            return $controller->session($token);
                        case 'spin':
                            return $controller->spin($request, $token);
                        case 'freenum':
                            return $controller->freenum($request, $token);
                        case 'icons':
                            return $controller->icons();
                    }
                }
            }
        } else {
            return response()->json([], 500);
        }
    }

    /**
     * @dev victormsalatiel
     * Store a newly created resource in storage.
     */
    public function toggleFavorite($id)
    {
        if(auth('api')->check()) {
            $checkExist = GameFavorite::where('user_id', auth('api')->id())->where('game_id', $id)->first();
            if(!empty($checkExist)) {
                if($checkExist->delete()) {
                    return response()->json(['status' => true, 'message' => 'Removido com sucesso']);
                }
            }else{
                $gameFavoriteCreate = GameFavorite::create([
                    'user_id' => auth('api')->id(),
                    'game_id' => $id
                ]);

                if($gameFavoriteCreate) {
                    return response()->json(['status' => true, 'message' => 'Criado com sucesso']);
                }
            }
        }
    }

    /**
     * @dev victormsalatiel
     * Store a newly created resource in storage.
     */
    public function toggleLike($id)
    {
        if(auth('api')->check()) {
            $checkExist = GameLike::where('user_id', auth('api')->id())->where('game_id', $id)->first();
            if(!empty($checkExist)) {
                if($checkExist->delete()) {
                    return response()->json(['status' => true, 'message' => 'Removido com sucesso']);
                }
            }else{
                $gameLikeCreate = GameLike::create([
                    'user_id' => auth('api')->id(),
                    'game_id' => $id
                ]);

                if($gameLikeCreate) {
                    return response()->json(['status' => true, 'message' => 'Criado com sucesso']);
                }
            }
        }
    }

    /**
     * @dev victormsalatiel
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Game::with(['categories', 'provider'])->whereStatus(1)->find($id);
        if(!empty($game)) {
            if(auth('api')->check()) {
                $wallet = Wallet::where('user_id', auth('api')->user()->id)->first();
                if($wallet->total_balance > 0) {
                    $game->increment('views');

                    $token = Helper::MakeToken([
                        'id' => auth('api')->user()->id,
                        'game' => $game->game_code
                    ]);

                    switch ($game->distribution) {
                        case 'source':
                            return response()->json([
                                'game' => $game,
                                'gameUrl' => url('/originals/'.$game->game_code.'/index.html?token='.$token),
                                'token' => $token
                            ]);

                            case 'playconnect':
                                $gameLauncher = self::GameLaunchPlayConnect($game);
                          
                                if($gameLauncher) {
                                  return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $gameLauncher,
                                    'token' => $token
                                  ]);
                                }else{
                                  return response()->json();
                                }

                        case 'venix':
                            $gameLauncher = self::GameLaunchVeniX($game);

                            if($gameLauncher) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $gameLauncher,
                                    'token' => $token
                                ]);
                            }else{
                                return response()->json();
                            }
                        case 'playigaming':
                            $gameLauncher = self::GameLaunchPIG($game);

                            if($gameLauncher) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $gameLauncher,
                                    'token' => $token
                                ]);
                            }else{
                                return response()->json();
                            }
                        case 'playgaming':
                            $gameLauncher = self::LaunchGamePlayGaming($game->game_id);

                            if($gameLauncher) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $gameLauncher,
                                    'token' => $token
                                ]);
                            }else{
                                return response()->json();
                            }
                        case 'salsa':
                            return response()->json([
                                'game' => $game,
                                'gameUrl' => self::playGameSalsa('CHARGED', 'BRL', 'pt', $game->game_id),
                                'token' => $token
                            ]);
                        case 'kagaming':
                            return response()->json([
                                'game' => $game,
                                'gameUrl' => self::GameLaunchKaGaming($game->game_server_url, $game->game_code),
                                'token' => $token
                            ]);
                        case 'evergame':
                            $evergameLaunch = self::GameLaunchEvergame($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                            if(isset($evergameLaunch['launchUrl'])) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $evergameLaunch['launchUrl'],
                                ]);
                            }else{
                                return response()->json($evergameLaunch);
                            }
                        case 'vibra_gaming':
                            return response()->json([
                                'game' => $game,
                                'gameUrl' => self::GenerateGameLaunch($game),
                                'token' => $token
                            ]);
                        case 'fivers':
                            $fiversLaunch = self::GameLaunchFivers($game->provider->code, $game->game_id, 'pt', auth('api')->id());
                            
                            // Log para debug
                            \Log::info('Fivers Launch Response:', [
                                'response' => $fiversLaunch,
                                'game_id' => $game->game_id,
                                'provider_code' => $game->provider->code
                            ]);
                            
                            if (!$fiversLaunch) {
                                return response()->json([
                                    'error' => 'Falha ao iniciar o jogo',
                                    'status' => false
                                ], 400);
                            }

                            // Verifica se é um array e se contém a chave launch_url
                            if (!is_array($fiversLaunch) || !isset($fiversLaunch['launch_url'])) {
                                // Se for string, usa como mensagem de erro
                                $errorMessage = is_string($fiversLaunch) ? $fiversLaunch : 'URL de lançamento não encontrada';
                                
                                return response()->json([
                                    'error' => $errorMessage,
                                    'status' => false
                                ], 400);
                            }

                            return response()->json([
                                'game' => $game,
                                'gameUrl' => $fiversLaunch['launch_url'],
                                'token' => $token
                            ]);
                        
                      case 'expfy':
                            $expfygameLaunch = self::GameLaunchExpfy($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                            if(isset($expfygameLaunch['launchUrl'])) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $expfygameLaunch['launchUrl'],
                                ]);
                            }else{
                                return response()->json($expfygameLaunch);
                            }
                      
                      
                      case 'games2_api':
                            $games2ApiLaunch = self::GameLaunchGames2($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                            if(isset($games2ApiLaunch['launch_url'])) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $games2ApiLaunch['launch_url'],
                                    'token' => $token
                                ]);
                            }

                            return response()->json(['error' => $games2ApiLaunch, 'status' => false ], 400);
                        case 'worldslot':
                            $worldslotLaunch = self::GameLaunchWorldSlot($game->provider->code, $game->game_id, 'pt', auth('api')->id());

                            if(isset($worldslotLaunch['launch_url'])) {
                                return response()->json([
                                    'game' => $game,
                                    'gameUrl' => $worldslotLaunch['launch_url'],
                                    'token' => $token
                                ]);
                            }

                            return response()->json(['error' => $worldslotLaunch, 'status' => false ], 400);

                    }
                }
                return response()->json(['error' => 'Você precisa ter saldo para jogar', 'status' => false, 'action' => 'deposit' ], 200);
            }
            return response()->json(['error' => 'Você precisa tá autenticado para jogar', 'status' => false ], 400);
        }
        return response()->json(['error' => '', 'status' => false ], 400);
    }

    /**
     * @dev victormsalatiel
     * Show the form for editing the specified resource.
     */


    /**
     * @dev victormsalatiel
     * Update the specified resource in storage.
     */
    public function webhookGoldApiMethod(Request $request)
    {
        return self::WebhooksFivers($request);
    }

    /**
     * @dev victormsalatiel
     * Update the specified resource in storage.
     */
    public function webhookUserBalanceMethod(Request $request)
    {
        return self::GetUserBalanceWorldSlot($request);
    }

    /**
     * @dev victormsalatiel
     * Update the specified resource in storage.
     */
    public function webhookGameCallbackMethod(Request $request)
    {
        return self::GameCallbackWorldSlot($request);
    }

    /**
     * @dev victormsalatiel
     * Update the specified resource in storage.
     */
    public function webhookMoneyCallbackMethod(Request $request)
    {
        return self::MoneyCallbackWorldSlot($request);
    }

    /**
     * Webhook Vibra Method
     *
     * @param Request $request
     * @param $parameters
     * @return array|\Illuminate\Http\JsonResponse|null
     */
    public function webhookVibraMethod(Request $request, $parameters)
    {
        return self::WebhookVibra($request, $parameters);
    }

    /**
     * @param Request $request
     * @return null
     */
    public function webhookKaGamingMethod(Request $request)
    {
        return self::WebhookKaGaming($request);
    }

    /**
     * @param Request $request
     * @return null
     */
    public function webhookSalsaMethod(Request $request)
    {
        return self::webhookSalsa($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function webhookVeniXMethod(Request $request)
    {
        return self::WebhookVeniX($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function webhookEvergameMethod(Request $request)
    {
        return self::WebhooksEvergame($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function webhookPlayGamingMethod(Request $request)
    {
        return self::WebhooksPlayGaming($request);
    }

    public function webhookPlayIGamingMethod(Request $request)
    {
        return self::WebhookPIG($request);
    }

    public function webhookPlayConnectMethod(Request $request)
    {
    return self::WebhooksPlayConnect($request);
    }

    public function getGamesByCategory($categoryId, Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $page = $request->get('page', 1);

            $category = Category::findOrFail($categoryId);
            
            $games = Game::with(['provider'])
                ->whereHas('categories', function($query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                })
                ->where('status', 1)
                ->paginate($perPage);

            return response()->json([
                'category' => $category->name,
                'games' => $games->items(),
                'pagination' => [
                    'current_page' => $games->currentPage(),
                    'last_page' => $games->lastPage(),
                    'per_page' => $games->perPage(),
                    'total' => $games->total()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Categoria não encontrada ou erro ao buscar jogos',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get all active providers with fivers distribution
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProviders()
    {
        try {
            $providers = Provider::where('status', 1)
                ->where('distribution', 'fivers')
                ->select([
                    'id',
                    'cover',
                    'code',
                    'name',
                    'status',
                    'rtp',
                    'views',
                    'distribution',
                    'created_at',
                    'updated_at'
                ])
                ->groupBy('code')
                ->orderBy('code')
                ->get();

            return response()->json([
                'status' => true,
                'providers' => $providers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar provedores'
            ], 500);
        }
    }

    /**
     * Get games with filters
     */
    public function allGames(Request $request)
    {
        $query = Game::query();
        $query->with(['provider', 'categories']);

        // Filtro por provedor
        if ($request->has('provider_id') && !empty($request->provider_id)) {
            $query->where('provider_id', $request->provider_id);
        }

        // Filtro por categoria
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->whereHas('categories', function ($categoryQuery) use ($request) {
                $categoryQuery->where('categories.id', $request->category_id);
            });
        }

        // Busca por termo (case insensitive)
        if ($request->has('search') && !empty($request->search) && strlen($request->search) >= 3) {
            $searchTerm = strtolower($request->search);
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(game_name) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(game_code) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereHas('provider', function($providerQuery) use ($searchTerm) {
                      $providerQuery->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTerm . '%']);
                  });
            });
            
            // Ordenar por relevância
            $query->orderByRaw("
                CASE 
                    WHEN LOWER(game_name) LIKE ? THEN 1
                    WHEN LOWER(game_name) LIKE ? THEN 2
                    ELSE 3 
                END", 
                [$searchTerm . '%', '%' . $searchTerm . '%']
            );
        } else {
            // Ordenação padrão por views quando não há busca
            $query->orderBy('views', 'desc');
        }

        // Status ativo
        $query->where('status', 1);

        // Paginação
        $perPage = $request->get('per_page', 12);
        $games = $query->paginate($perPage);

        return response()->json([
            'data' => $games->items(),
            'total' => $games->total(),
            'current_page' => $games->currentPage(),
            'per_page' => $games->perPage(),
            'last_page' => $games->lastPage()
        ]);
    }

    public function getProvidersWithGames(Request $request)
    {
        try {
            $cacheKey = 'providers_with_games_fivers_v1';
            $cacheDuration = 3600; // 1 hora

            return Cache::remember($cacheKey, $cacheDuration, function() {
                $startTime = microtime(true);

                $providers = Provider::select([
                        'id',
                        'name',
                        'code',
                        'cover',
                        'status',
                        'distribution',
                        'created_at',
                        'updated_at'
                    ])
                    ->where('status', 1)
                    ->where('distribution', 'fivers')
                    ->whereExists(function($query) {
                        $query->select(DB::raw(1))
                            ->from('games')
                            ->whereColumn('games.provider_id', 'providers.id')
                            ->where('games.status', 1)
                            ->where('games.show_home', 1);
                    })
                    ->with(['games' => function($query) {
                        $query->select(
                            'id',
                            'provider_id',
                            'game_name',
                            'game_code',
                            'cover',
                            'status',
                            'show_home',
                            'views',
                            'created_at',
                            'updated_at'
                        )
                        ->where('status', 1)
                        ->where('show_home', 1)
                        ->orderBy('views', 'desc');
                    }])
                    ->get();

                $result = $providers->map(function($provider) {
                    return [
                        'id' => $provider->id,
                        'name' => $provider->name,
                        'code' => $provider->code,
                        'cover' => $provider->cover,
                        'games' => $provider->games->map(function($game) {
                            return [
                                'id' => $game->id,
                                'game_name' => $game->game_name,
                                'game_code' => $game->game_code,
                                'cover' => $game->cover,
                                'views' => $game->views,
                                'created_at' => $game->created_at
                            ];
                        })->values()->all()
                    ];
                })->values()->all();

                $endTime = microtime(true);
                $executionTime = ($endTime - $startTime);

                \Log::info('Providers with games query executed', [
                    'providers_count' => count($result),
                    'total_games' => collect($result)->sum(function($provider) {
                        return count($provider['games']);
                    }),
                    'execution_time' => $executionTime
                ]);

                return [
                    'status' => true,
                    'providers' => $result,
                    'execution_time' => $executionTime,
                    'from_cache' => false
                ];
            });

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar provedores e jogos:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar provedores e jogos',
                'debug_message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
