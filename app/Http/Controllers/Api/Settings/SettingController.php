<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $startTime = microtime(true);

            // Query otimizada com campos reduzidos do Helper
            $result = DB::select("
                SELECT SQL_NO_CACHE 
                    software_name,
                    software_description,
                    software_logo_white,
                    software_logo_black,
                    currency_code,
                    decimal_format,
                    currency_position,
                    prefix,
                    storage,
                    min_deposit,
                    max_deposit,
                    min_withdrawal,
                    max_withdrawal,
                    initial_bonus,
                    suitpay_is_enable,
                    stripe_is_enable,
                    sharkpay_is_enable,
                    disable_spin,
                    disable_rollover
                FROM settings 
                FORCE INDEX (PRIMARY)
                LIMIT 1
                FOR SHARE SKIP LOCKED
            ");

            $endTime = microtime(true);
            $executionTime = ($endTime - $startTime);

            // Log apenas se demorar mais que 50ms
            if ($executionTime > 0.05) {
                Log::warning('Settings query slow:', [
                    'execution_time' => $executionTime
                ]);
            }

            return response()->json([
                'setting' => $result[0] ?? []
            ], 200, [], JSON_NUMERIC_CHECK);

        } catch (\Exception $e) {
            Log::error('Erro ao buscar configurações:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar configurações',
                'debug_message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Método para invalidar o cache manualmente se necessário
     */
    public function refreshCache()
    {
        try {
            Cache::forget('setting');
            return response()->json(['message' => 'Cache invalidado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao invalidar cache'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
