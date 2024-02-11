<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;
use App\Http\Middleware\AuthenticatedUser;

class SearchProductController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term from the request
        $searchTerm = $request->input('search');

        // Perform the search query
        $products = Product::where('name', 'like', "%{$searchTerm}%")
            ->orWhere('barcode', 'like', "%{$searchTerm}%")
            ->get();

        // Check if any products were found
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        // Return the products in the response
        return response()->json(['products' => $products]);
    }
}
