<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class ShowQuestionsController extends Controller
{
    public function index()
    {
        try {
            $question = Question::orderBy('created_at', 'desc')->paginate(10);
    
            $question->appends($request->query());
    
            if ($question->isEmpty()) {
                return response()->json([
                    'message' => 'No Questions Found',
                    'status' => 'Success',
                ]);
            }
    
            return response()->json([
                'status' => 'Success',
                'Questions'=>$question
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An Error Occurred While Fetching Questions',
                'status' => 'Failed',
            ]);
        }
    }
}
