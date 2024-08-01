<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama kategori wajib ada.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Panjang nama kategori maksimal 50 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::create($validator->validated());
        return response()->json(['message' => 'Kategori berhasil disimpan', 'category' => $category], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama kategori wajib ada.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Panjang nama kategori maksimal 50 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::findOrFail($id);
        $category->update($validator->validated());
        return response()->json(['message' => 'Kategori berhasil diupdate', 'category' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cek apakah kategori dengan ID yang diberikan ada
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
    
        // Hapus kategori
        $category->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
    
}
