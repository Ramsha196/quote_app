<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
            $request->validate([
            'category_name' => 'required|string'
        ]);
            $category = Category::create($request->all());
            return response()->json([
               'success' => true,
                'data' => $category
            ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:category,id,deleted_at,NULL'
        ]);

        $category = Category::find($request->id);
        $category->delete();

        return response()->json([
            'success' => true,
            'data' => $category
        ]);


    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:category,id,deleted_at,NULL',
            'category_name' => 'required|string'
        ]);

        $category = Category::find($request->id);
        $category->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $category
        ]);

    }

    public function listAll()
    {
        $category = Category::all();

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function listById(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:category,id,deleted_at,NULL'
        ]);

        $category = Category::find($request->id);
        return response()->json([
            'success' => true,
            'data' => $category

        ]);

    }
}
