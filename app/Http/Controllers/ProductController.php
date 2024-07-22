<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sortBy = $request->input('sort', 'asc');
        $categoryId = $request->input('category_id');

        $query = Product::query();

        // Search by keyword
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        // Filter by category
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Sort by name
        $query->orderBy('name', $sortBy);

        // Paginate results
        $products = $query->paginate(5);

        // $products = Product::with(['category', 'brand'])->get();

        return response()->json(['products' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ], [
            'name.required' => 'Nama produk wajib ada, harus berupa teks string, panjang maksimal adalah 50 karakter',
            'price.required' => 'Harga wajib ada',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok wajib ada',
            'stock.integer' => 'Stok harus berupa bilangan bulat',
            'category_id.required' => 'Kategori wajib ada dan harus valid',
            'category_id.exists' => 'Kategori tidak valid',
            'brand_id.required' => 'Brand wajib ada dan harus valid',
            'brand_id.exists' => 'Brand tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($validator->validated());

        return response()->json(['message' => 'Produk berhasil disimpan', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['product' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ], [
            'name.required' => 'Nama produk wajib ada, harus berupa teks string, panjang maksimal adalah 50 karakter',
            'price.required' => 'Harga wajib ada',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok wajib ada',
            'stock.integer' => 'Stok harus berupa bilangan bulat',
            'category_id.required' => 'Kategori wajib ada dan harus valid',
            'category_id.exists' => 'Kategori tidak valid',
            'brand_id.required' => 'Brand wajib ada dan harus valid',
            'brand_id.exists' => 'Brand tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($validator->validated());

        return response()->json(['message' => 'Produk berhasil diupdate', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    }

    
}
