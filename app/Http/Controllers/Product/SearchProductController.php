<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Middleware\AuthenticatedUser;

class SearchProductController extends Controller
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

        $products = Product::where('name', 'like', "%{$searchTerm}%")
            ->orWhere('barcode', 'like', "%{$searchTerm}%")
            ->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json(['products' => $products]);
    }
}
