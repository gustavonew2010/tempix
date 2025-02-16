<?php

use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Verification\VerificationController;
use App\Http\Controllers\Api\Profile\AddressController;
use App\Http\Controllers\Api\Profile\DocumentController;

Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/getLanguage', [ProfileController::class, 'getLanguage']);
Route::put('/updateLanguage', [ProfileController::class, 'updateLanguage']);
Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar']);
Route::post('/updateName', [ProfileController::class, 'updateName']);
Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/verification/email', [VerificationController::class, 'sendEmailVerification']);
Route::get('/search-cep/{cep}', [AddressController::class, 'searchCEP']);
Route::get('/search-cpf', [ProfileController::class, 'searchCPF']);

Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index']);
    Route::post('/', [DocumentController::class, 'store']);
});
