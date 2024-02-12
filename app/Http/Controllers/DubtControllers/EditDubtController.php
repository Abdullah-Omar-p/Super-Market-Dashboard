<?php

namespace App\Http\Controllers\DubtControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, User};

class EditDubtController extends Controller
{
    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id' => 'required|exists:debts,id',
            'status' => 'required|in:1,0',
            'name' => 'required|string|max:255',
            'increment_or_decrement' => 'required|integer|in:1,0',
            'money' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $debt = Debt::find($request->id);

        if ($request->increment_or_decrement == 1) {
            
            $newLiability = $debt->liability - $request->money ;

        }elseif ($request->increment_or_decrement == 0) {

            $newLiability = $debt->liability + $request->money ;
        }

        try {

            $debt->status = $validatedData['status'];
            $debt->name = $validatedData['name'];
            $debt->liability = $newLiability;
            $debt->phone = $validatedData['phone'];
        
            $debt->save();   

            $user = auth()->user();


                if ($debt) {
                    activity()
                    ->causedBy($user)
                    ->performedOn($debt)
                    ->log('تم تحديث مديونية ');
                }

            return response()->json(['message' => 'Debt updated successfully', 'debt' => $debt]);
        } catch (\Exception $e) {
            // Handle any errors that occur during debt update
            return response()->json(['message' => 'Error updating debt', 'error' => $e->getMessage()], 500);
        }
    }    
}
