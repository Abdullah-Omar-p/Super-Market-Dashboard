<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class AddQuestionController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'question' => 'required|unique:products|string',
            'answer' => 'required|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'answered_by' => 'required|exists:users,id',
        ]);
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $question = new Question;
        $question->title = $request->title;
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->user_id = $request->user_id;
        $question->answered_by = $request->answered_by;

        $question->save();

        $user = auth()->user();

        if ($question) {
            activity()
            ->causedBy($user)
            ->performedOn($question)
            ->log('New Question.');
        }

        if (!$question) {
            return response()->json([
                'status' => 'Failed.',
                'message' => 'Error ,Try Again Later.',
                'question' => $question,
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Question Added Successfully.',
            'question' => $question,
        ]);
    }
}
