<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();

        return response()->json([
            'success' => true,
            'message' => 'Tests retrieved successfully',
            'data' => $tests
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'rating' => 'required|numeric',
        ]);

        $test = new Test();
        $test->name = $request->input('name');
        $test->status = $request->input('status');
        $test->rating = $request->input('rating');
        $test->save();

        return response()->json([
            'success' => true,
            'message' => 'Test created successfully',
            'data' => $test
        ]);
    }

    public function show($id)
    {
        $test = Test::find($id);

        if (!$test) {
            return response()->json([
                'success' => false,
                'message' => 'Test not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Test retrieved successfully',
            'data' => $test
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'rating' => 'required|numeric',
        ]);

        $test = Test::find($id);

        if (!$test) {
            return response()->json([
                'success' => false,
                'message' => 'Test not found',
                'data' => null
            ], 404);
        }

        $test->name = $request->input('name');
        $test->status = $request->input('status');
        $test->rating = $request->input('rating');
        $test->save();

        return response()->json([
            'success' => true,
            'message' => 'Test updated successfully',
            'data' => $test
        ]);
    }

    public function destroy($id)
    {
        $test = Test::find($id);

        if (!$test) {
            return response()->json([
                'success' => false,
                'message' => 'Test not found',
                'data' => null
            ], 404);
        }

        $test->delete();

        return response()->json([
            'success' => true,
            'message' => 'Test deleted successfully'
        ]);
    }
}
