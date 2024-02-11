<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; 
use App\Http\Middleware\AuthenticatedUser;

class ActivitiesController extends Controller
{
    public function index()
    {
        try {
            $activities = Activity::orderBy('created_at', 'desc')->paginate(10);
    
            $activities->appends($request->query());
    
            if ($activities->isEmpty()) {
                return response()->json(['message' => 'No activities found']);
            }
    
            return response()->json($activities);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching activities']);
        }
    }
}
