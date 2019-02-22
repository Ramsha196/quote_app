<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MediaController extends Controller
{
    public function create(Request $request)

    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,mpga,wav,max:500000',
            'name' => 'required|string',
        ]);

        $media = new Media();
        $media->name = $request->name;
        $media->save();
        $file = $request->file('file');
        $destinationPath = public_path('storage').'/media/'.$media->id;
        $originalFile = $file->getClientOriginalName();
        $media->type = $request->type;
        $media->update(['type' => $file->getClientOriginalExtension()]);
        $filename=$originalFile;
        $file->move($destinationPath, $filename);
        $media->update(['path' => asset('storage/media/'.$media->id.'/'.$originalFile)]);
        return response()->json([
           'success' => true,
           'file' =>  asset('storage/media/'.$media->id.'/'.$originalFile)
        ]);

    }

    public function update(Request $request)

    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,mpga,wav,max:50',
            'name' => 'required|string',
        ]);

        $media = Media::find($request->id);
        $media->name = $request->name;
        $path = $media->path;
        $file = basename($path);
        @unlink('storage/media/'.$request->id.'/'.$file);
        $file = $request->file('file');
        $destinationPath = public_path('storage').'/media/'.$media->id;
        $originalFile = $file->getClientOriginalName();
        $media->type = $request->type;
        $media->update(['type' => $file->getClientOriginalExtension()]);
        $filename=$originalFile;
        $file->move($destinationPath, $filename);
        $media->update(['path' => asset('storage/media/'.$media->id.'/'.$originalFile)]);

        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }

public function delete(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:media,id,deleted_at,NULL'
    ]);

    $media = Media::find($request->id);
    $path = $media->path;
    $file = basename($path);
    @unlink('storage/media/'.$request->id.'/'.$file);
    $media->delete();
        return response()->json([
           'success' => true
        ]);



}

    public function listAll()
    {
        $media = Media::all();

        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }

    public function listById(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:media,id,deleted_at,NULL'
        ]);

        $media = Media::find($request->id);
        return response()->json([
            'success' => true,
            'data' => $media

        ]);

    }

    public function randomAudio()
    {
        $media = Media::where('type','mp3')->orderByRaw("RAND()")->first();
        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }

    public function randomImage()
    {
        $media = Media::where('type', 'jpg')->orderByRaw("RAND()")->first();
        return response()->json([
            'success' => true,
            'data' => $media

        ]);
    }


}
