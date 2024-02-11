<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchBarCodeOrNameController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required_without:barcode|string',
            'barcode' => 'required_without:name|unique:products|string',
        ]);
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        $searchTerm = $request->input('search');

        $product = Product::where('name',"{$searchTerm}")
            ->orWhere('barcode',"{$searchTerm}")
            ->first();

        if ($product->isEmpty()) {
            return response()->json(['message' => 'المنتج غير موجود'], 404);
        }

        return response()->json(['product' => $product]);
    }
}
