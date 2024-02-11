<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;
use App\Http\Middleware\AuthenticatedUser;

class DeleteProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        $authUser = auth()->user();
        $user = User::find($authUser->id);

        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('New Product Deleted.');
        }

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
