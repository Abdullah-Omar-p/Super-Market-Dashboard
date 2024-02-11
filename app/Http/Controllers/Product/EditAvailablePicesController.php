<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;
use App\Http\Middleware\AuthenticatedUser;

class EditAvailablePicesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'available_pices' => 'required|integer',
        ]);

        $product = Product::find($request->product_id);

        $product->available_pices = $request->input('available_pices');
        
        $product->save();

        $authUser = auth()->user();
        $user = User::find($authUser->id);

        if ($product) {
            activity()
            ->causedBy($user)
            ->performedOn($product)
            ->log('New Pices Added.');
        }

        return response()->json([
            'message' => 'Available pieces updated successfully', 
            'available' => $product->available_pices
        ]);
    }
}
