<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function create(Request $request)

    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,mpga,wav,max:50',
            'type' => 'required',
            'name' => 'required|string',
        ]);

        $media = new Media();
        $media->name = $request->name;
        $media->type = $request->type;
        $media->save();
        $file = $request->file('file');
        $destinationPath = public_path('storage').'/media/'.$media->id;
        $originalFile = $file->getClientOriginalName();
        $filename=$originalFile;
        $file->move($destinationPath, $filename);
        $media->update(['path' => asset('storage/media/'.$media->id.'/'.$originalFile)]);
        return response()->json([
           'success' => true,
           'file' =>  asset('storage/media/'.$media->id.'/'.$originalFile)
        ]);

    }
}
