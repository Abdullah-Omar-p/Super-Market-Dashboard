<?php

namespace App\Http\Controllers\DubtControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, User};

class DeleteDubtController extends Controller
{
    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'debt_id' => 'required|exists:debts,id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $debt = Debt::find($request->debt_id);

        if (!$debt) {
            return response()->json(['message' => 'debt not found'], 404);
        }

        try {
            // Delete the debt record
            $debt->delete();

            $authUser = auth()->user();
            $user = User::find($authUser->id);

                if ($product) {
                    activity()
                    ->causedBy($user)
                    ->performedOn($debt)
                    ->log('تم حذف مديونية ');
                }
            return response()->json(['message' => 'Debt deleted successfully']);
        } catch (\Exception $e) {
            // Handle any errors that occur during debt deletion
            return response()->json(['message' => 'Error deleting debt', 'error' => $e->getMessage()], 500);
        }
    }
}
