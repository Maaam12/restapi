<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'school' => 'required|string',
            'class' => 'required|string',
            'address' => 'required|string',
            'about' => 'nullable|string',
        ]);
        
        $profile = new Profile();
        $profile->fill($request->all());
        $profile->user_id = Auth::id();
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile created successfully',
            'data' => $profile
        ]);
    }

    public function show(Request $request)
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data' => $profile
        ]);
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'school' => 'required|string',
            'class' => 'required|string',
            'address' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->fill($request->all());
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }

    public function delete(Request $request)
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile deleted successfully'
        ]);
    }
}
