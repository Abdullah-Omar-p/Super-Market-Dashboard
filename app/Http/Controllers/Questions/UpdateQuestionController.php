<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class UpdateQuestionController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:questions,id',
            'title' => 'required|string',
            'question' => 'required|string|max:5000',
            'answer' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'answered_by' => 'required|exists:users,id',
        ]);
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $updateQuestion = Question::find($request->id);

        $updateQuestion->update($validatedData);

        $user = auth()->user();


        if ($updateQuestion) {
            activity()
            ->causedBy($user)
            ->performedOn($updateQuestion)
            ->log('New Question Updated.');
        }

        return response()->json(['message' => 'Question Updated Successfully.', 'question' => $updateQuestion]);

    }
}
