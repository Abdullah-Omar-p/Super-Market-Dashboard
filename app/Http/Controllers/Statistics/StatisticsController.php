<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Order, Product};
use Carbon\Carbon;

class StatisticsController extends Controller
{
    
    public function getDailyStats()
    {
        $today = Carbon::today();
        $totalEarnOfDay = Order::whereDate('created_at', $today)->sum('total_price');
        $totalSoldProducts = Order::whereDate('created_at', $today)->sum('no_products');

        $responseData = [
            'total_earn_of_day' => $totalEarnOfDay,
            'total_sold_products' => $totalSoldProducts
        ];

        return response()->json($responseData);
    }

    public function getWeeklyStats()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $totalEarnOfWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_price');
        $totalSoldProducts = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('no_products');


        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $addedProductsForWeek = Product::whereDate('created_at', '>', $startOfLastWeek)->count();

        $responseData = [
            'total_earn_of_week' => $totalEarnOfWeek,
            'total_sold_products' => $totalSoldProducts,
            'added_products_for_week' => $addedProductsForWeek
        ];

        return response()->json($responseData);
    }

    public function getMonthlyStats()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $totalEarnOfMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');
        $totalSoldProducts = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('no_products');

        $responseData = [
            'total_earn_of_month' => $totalEarnOfMonth,
            'total_sold_products' => $totalSoldProducts
        ];

        return response()->json($responseData);
    }
}
