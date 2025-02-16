<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::select([
                    'id',
                    'name',
                    'slug',
                    'image',
                    'icon',
                    'order',
                    'is_menu_item',
                    'is_dropdown',
                    'parent_id'
                ])
                ->orderBy('order')
                ->where('is_menu_item', true)
                ->get();

            $result = [];
            foreach ($categories as $category) {
                $result[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'image' => $category->image,
                    'icon' => $category->icon,
                    'order' => $category->order,
                    'is_menu_item' => $category->is_menu_item,
                    'is_dropdown' => $category->is_dropdown,
                    'parent_id' => $category->parent_id
                ];
            }

            return response()->json([
                'status' => true,
                'categories' => $result
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao buscar categorias:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar categorias',
                'debug_message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
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
