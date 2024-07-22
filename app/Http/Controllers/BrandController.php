<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama brand wajib ada.',
            'name.string' => 'Nama brand harus berupa teks.',
            'name.max' => 'Panjang nama brand maksimal 50 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $brand = Brand::create($validator->validated());
        return response()->json(['message' => 'Brand berhasil disimpan', 'brand' => $brand], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama brand wajib ada.',
            'name.string' => 'Nama brand harus berupa teks.',
            'name.max' => 'Panjang nama brand maksimal 50 karakter.',
        ]); 

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $brand = Brand::findOrFail($id);
        $brand->update($validator->validated());
        return response()->json(['message' => 'Brand berhasil diupdate', 'brand' => $brand], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return response()->json(['message' => 'Brand berhasil dihapus'], 200);
    }
}
