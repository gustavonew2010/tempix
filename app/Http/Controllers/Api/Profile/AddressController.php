<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Services\CEPService;

class AddressController extends Controller
{
    protected $cepService;

    public function __construct(CEPService $cepService)
    {
        $this->cepService = $cepService;
    }

    public function searchCEP($cep)
    {
        return response()->json($this->cepService->consultarCEP($cep));
    }
} 