<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, User};
use App\Http\Middleware\AuthenticatedUser;

class UpdateProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'barcode' => 'nullable|string|unique:products',
            'description' => 'nullable|string',
            'available_pices' => 'required|integer',
            'price' => 'required|integer',
        ]);
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode') ?? null;
        $product->description = $request->input('description') ?? null;
        $product->available_pices = $request->input('available_pices');
        $product->price = $request->input('price');

        $product->save();

        if (!$product) {
            return response()->json(['message' => 'مشكلة اثناء تحديث المنتج, حاول لاحقا']);
        }

        $user = auth()->user();


        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('تحديث منتج');
        }

        return response()->json(['message' => 'تم تحديث المنتج بنجاح', 'product' => $product]);
    }
}
