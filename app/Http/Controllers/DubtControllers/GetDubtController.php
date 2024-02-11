<?php

namespace App\Http\Controllers\DubtControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debt;

class GetDubtController extends Controller
{
    public function index(Request $request)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        try {

            $debts = Debt::where('status', $request->status)->get();

            return response()->json(['debts' => $debts]);

        } catch (ModelNotFoundException $exception) {

            return response()->json(['error' => 'Debts not found'], 404);
            
        } catch (Exception $exception) {

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
