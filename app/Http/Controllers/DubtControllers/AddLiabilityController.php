<?php

namespace App\Http\Controllers\DubtControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, User};

class AddLiabilityController extends Controller
{
    public function index(Request $request)
    {

        $validatedData = $request->validate([
            'status' => 'required|in:1,0',
            'name' => 'required|string|max:255',
            'liability' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
        ]);

        try {

            $debt = Debt::create($validatedData);

            $user = auth()->user();


                if ($product) {
                    activity()
                    ->causedBy($user)
                    ->performedOn($debt)
                    ->log('تم اضافة مديونية جديدة');
                }
            return response()->json(['message' => 'Debt created successfully', 'debt' => $debt], 201);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error creating debt', 'error' => $e->getMessage()], 500);
        }
    }
}
