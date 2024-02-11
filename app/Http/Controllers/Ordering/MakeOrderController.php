<?php

namespace App\Http\Controllers\Ordering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MakeOrderController extends Controller
{
    // he will search about the product with SearchProductController and add it if not found by AddProductController
    // and here you will receive all incoming data and save it in orders and order_product ..

    // there are also ability to make order by products that not founded just by write it name and price 
    // and then sum total price and save order , but only in orders not order_product table

    // when he make an order available pices of product will decreases 1 for every order about it 
}
