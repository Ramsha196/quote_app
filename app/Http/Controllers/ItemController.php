<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'audio_id' => 'exists:media,id',
            'background_image_id' => 'exists:media,id',
            'application_id' => 'exists:applications,id',
            'category_ids' => 'required|array|exists:category,id,deleted_at,NULL',
            'content_source' => 'string'
        ]);

        $item = Item::create($request->all());
        $category = Category::find($request->category_ids);
        $item->categories()->attach($category);
        $item->save();
        return response()->json([
            'success' => true,
            'data' => $item
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:items,id,deleted_at,NULL'
        ]);

        $item = Item::find($request->id);
        $item->delete();

        return response()->json([
            'success' => true,
            'data' => $item
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:items,id',
            'content' => 'required|string',
            'audio_id' => 'exists:media,id',
            'background_image_id' => 'exists:media,id',
            'application_id' => 'exists:applications,id',
            'category_ids' => 'required|array|exists:category,id,deleted_at,NULL',
            'content_source' => 'string'
        ]);

        $item = Item::find($request->id);
        $item->update($request->all());
        $category = Category::find($request->category_ids);
        $item->categories()->sync($category);
        $item->save();

        return response()->json([
            'success' => true,
            'data' => $item
        ]);


    }

    public function listAll()
    {
        $item = Item::with('categories', 'audio', 'background_image')->get();

        return response()->json([
            'success' => true,
            'data' => $item
        ]);
    }

    public function listById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:items,id'
        ]);

        $item = Item::with('categories', 'audio', 'background_image')->get()->find($request->id);

        return response()->json([
            'success' => true,
            'data' => $item,

        ]);

    }


    public function itemByCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:category,id,deleted_at,NULL'
        ]);

        $id = $request->id;

       $item =  Item::whereHas('categories', function ($query) use ($id) {
            return $query->where('category.id', $id);
        })->with('categories', 'audio', 'background_image')->get();

       return response()->json(
           ['data' => $item
           ]
       );

    }


}

