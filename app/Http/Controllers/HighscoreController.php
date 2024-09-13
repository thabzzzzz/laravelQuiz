<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HighScore;
use Illuminate\Support\Facades\Log;

class HighScoreController extends Controller
{
   

    public function store(Request $request)
    {
        Log::info('Highscore upload initiated.');
    
        // Log the incoming request data
        Log::info('Request data:', $request->all());
    
        // Validate incoming request data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'quiz_id' => 'required|integer',
            'score' => 'required|integer',
        ]);
    
        Log::info('Validation passed.');
    
        // Check if the highscore already exists for the quiz and user
        $existingScore = Highscore::where('username', $validated['username'])
                                  ->where('quiz_id', $validated['quiz_id'])
                                  ->first();
    
        if ($existingScore) {
            // Update the existing highscore if the new score is higher
            Log::info('Existing highscore found. Updating the score.');
            $existingScore->update(['score' => $validated['score']]);
        } else {
            // Create a new highscore
            Log::info('No existing highscore. Creating a new one.');
            Highscore::create($validated);
        }
    
        Log::info('Highscore saved successfully.');
        
        return response()->json(['message' => 'Highscore uploaded successfully!']);
    }
    
    public function index()
{
    $highscores = Highscore::all(); // Fetch all highscores
    return response()->json($highscores);
}

public function getTopHighScores()
{
    // Fetch the top 5 users based on their highest scores
    $topScores = HighScore::with('quiz')  // Make sure this relationship exists
        ->orderBy('score', 'desc')  // Order by score in descending order
        ->take(5)                   // Limit to top 5 scores
        ->get();

    return response()->json($topScores);
}
}
