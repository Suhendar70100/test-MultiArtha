<?php

namespace App\Http\Controllers\API;

use App\Models\People;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeopleRequest;

class PeopleController extends Controller
{
    public function index()
    {
        try {
            $people = People::all();
            return response()->json([
                'message' => "succes fetching people",
                'data' => $people
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching people',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeopleRequest $request)
    {
        try {
            $people = People::create($request->validated());
            return response()->json([
                'message' => 'People created successfully',
                'data' => $people
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating people',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $people = People::findOrFail($id);
            return response()->json([
                'message' => "People detail",
                'data' => $people
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'People not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching people',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeopleRequest $request, string $id)
    {
        try {
            $people = People::findOrFail($id); 
            $people->update($request->validated());
            return response()->json([
                'message' => 'People updated successfully',
                'data' => $people
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'People not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating people',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $people = People::findOrFail($id);
            $people->delete();
            return response()->json([
                'message' => 'People deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'People not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting people',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
