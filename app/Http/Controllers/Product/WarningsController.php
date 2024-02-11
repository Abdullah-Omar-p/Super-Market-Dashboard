<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;
use App\Http\Middleware\AuthenticatedUser;

class WarningsController extends Controller
{
    public function index()
    {
        // .. Get Products With Available Pieces Less Than 90 ..
        $products = Product::where('available_pices', '<', 90)->get();

        // .. Check If There Are Any Products With Low Available Pieces ..
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products with low available pieces']);
        }

        // .. Warning Message For Each Product ..
        $warningMessages = [];
        foreach ($products as $product) {
            $warningMessages[] = "Product Id = {$product->id} \n Product {$product->name} has only {$product->available_pices} pieces left!";
        }

        return response()->json(['warning_messages' => $warningMessages]);
    }

}
