<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();

        return response()->json([
            'success' => true,
            'message' => 'Profiles retrieved successfully',
            'data' => $profiles
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'school' => 'required|string',
            'class' => 'required|string',
            'address' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $profile = new Profile();
        $profile->school = $request->input('school');
        $profile->class = $request->input('class');
        $profile->address = $request->input('address');
        $profile->about = $request->input('about');
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile created successfully',
            'data' => $profile
        ]);
    }

    public function show($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data' => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'school' => 'required|string',
            'class' => 'required|string',
            'address' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'data' => null
            ], 404);
        }

        $profile->school = $request->input('school');
        $profile->class = $request->input('class');
        $profile->address = $request->input('address');
        $profile->about = $request->input('about');
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }


    public function destroy($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'data' => null
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile deleted successfully'
        ]);
    }
}
