<?php

use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Games\GameController;
use App\Http\Controllers\Api\Search\SearchGameController;
use App\Http\Controllers\Api\Profile\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
 * Auth Route with JWT
 */
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    include_once(__DIR__ . '/groups/api/auth/auth.php');
});

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::prefix('profile')
        ->group(function ()
        {
            include_once(__DIR__ . '/groups/api/profile/profile.php');
            include_once(__DIR__ . '/groups/api/profile/affiliates.php');
            include_once(__DIR__ . '/groups/api/profile/wallet.php');
            include_once(__DIR__ . '/groups/api/profile/likes.php');
            include_once(__DIR__ . '/groups/api/profile/favorites.php');
            include_once(__DIR__ . '/groups/api/profile/recents.php');
            include_once(__DIR__ . '/groups/api/profile/vip.php');
            
            // Rotas de Afiliados
            Route::prefix('affiliates')->group(function () {
                Route::get('/', 'App\Http\Controllers\Api\Profile\AffiliateController@index');
                Route::get('/generate', 'App\Http\Controllers\Api\Profile\AffiliateController@generate');
                Route::post('/request', 'App\Http\Controllers\Api\Profile\AffiliateController@request');
            });

            // Rota para atualização do avatar
            Route::post('/upload-avatar', [ProfileController::class, 'updateAvatar']);

            // Endpoint para envio de documentos
            Route::post('/documents', [App\Http\Controllers\Api\Profile\DocumentController::class, 'store']);

            // Endpoint para atualização dos dados pessoais
            Route::put('/update-personal-data', [App\Http\Controllers\Api\Profile\ProfileController::class, 'updatePersonalData']);

            // Rota para alteração de senha
            Route::post('/change-password', [App\Http\Controllers\Api\Profile\ProfileController::class, 'changePassword']);

            Route::get('/verification', [VerificationController::class, 'index']);
            Route::post('/verification/points', [VerificationController::class, 'updatePoints']);
            Route::post('/verification/complete-step', [VerificationController::class, 'completeStep']);
        });

    Route::prefix('wallet')
        ->group(function ()
        {
            include_once(__DIR__ . '/groups/api/wallet/deposit.php');
            include_once(__DIR__ . '/groups/api/wallet/withdraw.php');
        });

    include_once(__DIR__ . '/groups/api/missions/mission.php');;
    include_once(__DIR__ . '/groups/api/missions/missionuser.php');;

    Route::prefix('verification')->group(function () {
        Route::post('/phone', [\App\Http\Controllers\Api\Verification\VerificationController::class, 'sendPhoneVerification']);
        Route::post('/email', [\App\Http\Controllers\Api\Verification\VerificationController::class, 'sendEmailVerification']);

        // Rotas adicionadas para confirmar os códigos (email e telefone)
        Route::post('/email/confirm', [\App\Http\Controllers\Api\Verification\VerificationController::class, 'confirmEmailVerification']);
        Route::post('/phone/confirm', [\App\Http\Controllers\Api\Verification\VerificationController::class, 'confirmPhoneVerification']);
    });
});


Route::prefix('categories')
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/api/categories/index.php');;
    });

include_once(__DIR__ . '/groups/api/games/index.php');
include_once(__DIR__ . '/groups/api/gateways/digitopay.php');
include_once(__DIR__ . '/groups/api/gateways/ezzebank.php');
include_once(__DIR__ . '/groups/api/gateways/suitpay.php');

Route::prefix('search')
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/api/search/search.php');
    });

Route::prefix('providers')
    ->group(function ()
    {
        Route::get('/', [GameController::class, 'getProviders']);
    });


Route::prefix('settings')
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/api/settings/settings.php');
        include_once(__DIR__ . '/groups/api/settings/banners.php');
        include_once(__DIR__ . '/groups/api/settings/currency.php');
        include_once(__DIR__ . '/groups/api/settings/bonus.php');
    });
// LANDING SPIN
Route::prefix('spin')
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/api/spin/index.php');
    })
    ->name('landing.spin.');

Route::group(['prefix' => 'games'], function () {
    Route::get('/', [GameController::class, 'index']);
    Route::get('/featured', [GameController::class, 'featured']);
    Route::get('/search', [SearchGameController::class, 'index'])
        ->middleware('api')
        ->name('api.games.search');
    Route::get('/single/{id}', [GameController::class, 'show']);
    Route::post('/toggle-favorite/{id}', [GameController::class, 'toggleFavorite']);
    Route::post('/toggle-like/{id}', [GameController::class, 'toggleLike']);
});

Route::get('/providers-with-games', [GameController::class, 'getProvidersWithGames']);

