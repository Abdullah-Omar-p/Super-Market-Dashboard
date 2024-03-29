<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Middleware\AuthenticatedUser;

class DeleteProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        $user = auth()->user();


        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('تم حذف منتج');
        }

        return response()->json(['message' => 'تم حذف المنتج بنجاح']);
    }
}
