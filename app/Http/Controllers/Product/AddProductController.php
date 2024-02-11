<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, User};
use App\Middleware\AuthenticatedUser;

class AddProductController extends Controller
{
    public function index(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'barcode' => 'nullable|unique:products|string',
            'description' => 'nullable|string',
            'available_pices' => 'required|integer',
            'price' => 'required|integer',
        ]);
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        // Create a new product instance and populate it with the validated data
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->barcode = $validatedData['barcode'];
        $product->description = $validatedData['description'] ?? null;
        $product->price = $validatedData['price'];
        $product->available_pices = $validatedData['available_pices'];

        // Save the product to the database
        $product->save();

        $user = auth()->user();

        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('تم اضافة منتج جديد');
        }

        // Return a success response
        return response()->json([
            'status' => 'عملية ناجحة',
            'message' => 'تم اضافة المنتج بنجاح',
            'product' => $product,
        ]);
    }
}
