<?php

namespace App\Http\Controllers\DubtControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, User};

class EditDubtController extends Controller
{
    public function update(Request $request, Debt $debt)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'status' => 'required|in:1,0',
            'name' => 'required|string|max:255',
            'liability' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        try {
            // Update the debt record
            $debt->update($validatedData);
            
            $authUser = auth()->user();
            $user = User::find($authUser->id);

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
