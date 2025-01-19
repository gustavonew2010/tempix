<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Força o header Accept para JSON
            $request->headers->set('Accept', 'application/json');

            $query = Game::query();
            $query->with(['provider']);

            if ($request->has('searchTerm') && strlen($request->searchTerm) >= 3) {
                $searchTerm = $request->searchTerm;
                
                $query->where(function($q) use ($searchTerm) {
                    $q->where('game_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('game_code', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('game_id', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhereHas('provider', function($providerQuery) use ($searchTerm) {
                          $providerQuery->where('name', 'LIKE', "%{$searchTerm}%");
                      });
                });
            }

            $query->where('status', 1);
            $games = $query->orderBy('views', 'desc')
                          ->paginate(12)
                          ->appends($request->query());

            // Força a resposta como JSON
            return response()->json([
                'status' => true,
                'games' => $games
            ])->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            Log::error('Erro na busca de jogos: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar jogos',
                'error' => $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
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
