<?php

namespace App\Http\Controllers;

use App\Applications;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        $application = Applications::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $application
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:applications,id,deleted_at,NULL'
        ]);

        $application = Applications::find($request->id);
        $application->delete();

        return response()->json([
            'success' => true,
            'data' => $application
        ]);


    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:applications,id,deleted_at,NULL',
            'name' => 'required|string'
        ]);

        $application = Applications::find($request->id);
        $application->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $application
        ]);

    }

    public function listAll()
    {
        $application = Applications::all();

        return response()->json([
            'success' => true,
            'data' => $application
        ]);
    }
}
