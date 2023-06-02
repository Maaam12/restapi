<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobCategories = JobCategory::all();
        return response()->json($jobCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jobCategory = JobCategory::create($request->all());
        return response()->json($jobCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jobCategory = JobCategory::find($id);

        if (!$jobCategory) {
            return response()->json(['error' => 'Kategori pekerjaan tidak ditemukan'], 404);
        }

        return response()->json($jobCategory);
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jobCategory = JobCategory::find($id);

        if (!$jobCategory) {
            return response()->json(['error' => 'Kategori pekerjaan tidak ditemukan'], 404);
        }

        $jobCategory->fill([
            'name' => $request->name,
        ]);
        $jobCategory->save();

        return response()->json($jobCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jobCategory = JobCategory::find($id);

        if (!$jobCategory) {
            return response()->json(['error' => 'Kategori pekerjaan tidak ditemukan'], 404);
        }

        $jobCategory->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
