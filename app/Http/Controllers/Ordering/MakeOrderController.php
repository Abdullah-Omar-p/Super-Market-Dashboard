<?php

namespace App\Http\Controllers\Ordering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, Product};

class MakeOrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_ids' => 'required|array',
                'total_price' => 'nullable|integer',
                'no_pices' => 'nullable|integer',
                'product_ids.*' => 'exists:products,id',
            ]);

            // .. Calculate Total Price For Order ..
            $total_price = 0 ;
            foreach ($productsIds as $products_ids) {
                $product = Product::find($products_ids);
                $price = $product->price;

                $total_price = $price + $total_price;
            }
    
            // dont forget to calculate total price ..
            $productsIds = [];
            $productsIds = $request->product_ids;

            foreach ($productsIds as $products_ids) {
                $product = Product::find($products_ids);

                $decrease = $product->decrement('available_pices'); // that decreases pices 1 pice for each product
            }
            
            // .. Calculate Number Of Products In Order ..
            $no_products = count($productsIds);
            
            // .. Create Order Record In 'orders' ..
            $order = new Order();
            $order->total_price = $total_price;
            $order->no_products = $no_products;
            $order->save();

            
            $user = auth()->user();

            if ($order) {
                activity()
                ->causedBy($user)
                ->performedOn($order)
                ->log('تم عمل طلب');
            }

            // .. This To Fill Pivot 'order_product' Table By Records Of Added Products To Order ..
            $order->products()->attach($validatedData['product_ids']);

            // .. Get All Products Of The Order , Select name,price,availablepices ..
            $products = Product::whereIn('id', $productsIds)->get(['name', 'price', 'available_pices']);
            $responseData ['products'] = $products;
            // .. Add total Price To Response ..
            $responseData ['total-price'] = $total_price;
            // .. Add number of pices To Response ..
            $responseData ['no - pices'] = $no_products;

            return response()->json($responseData);

        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
