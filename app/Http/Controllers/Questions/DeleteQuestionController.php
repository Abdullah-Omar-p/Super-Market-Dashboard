<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class DeleteQuestionController extends Controller
{
    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'question_id' => 'required|exists:debts,id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $question = Question::find($request->question_id);

        try {

            $question->delete();

            $user = auth()->user();


                if ($question) {
                    activity()
                    ->causedBy($user)
                    ->performedOn($question)
                    ->log('Question Deleted.');
                }
            return response()->json(['message' => 'Question deleted successfully']);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error deleting Question', 'error' => $e->getMessage()], 500);
        }
    }
}
