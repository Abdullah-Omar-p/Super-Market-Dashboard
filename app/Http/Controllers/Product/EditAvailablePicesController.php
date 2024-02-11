<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Middleware\AuthenticatedUser;

class EditAvailablePicesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'available_pices' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $product = Product::find($request->product_id);

        $product->available_pices = $request->input('available_pices');
        
        $product->save();

        $authUser = auth()->user();
        $user = User::find($authUser->id);

        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('اضافة قطع جديدة لمنتج');
        }

        return response()->json([
            'message' => 'تم اضافة القطع بنجاح', 
            'available' => $product->available_pices
        ]);
    }
}
