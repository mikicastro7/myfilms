<?php

namespace App\Http\Controllers;

use DB;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
class RatingController extends Controller
{
    public function postStar (Request $request) {
        // Find if a user posted a rating of a movie if it find a post update else create a new
        $sessioIniciada = Auth::id();

        if(empty($sessioIniciada)){
            return response()->json(['error' => 401]);
        } else{
         $movie =  Movie::findOrfail($request->movieId);
         $rate = $request->rate;
         $rating =  Rating::where('movie_id', '=', $movie->id)->where('user_id', '=', Auth::id())->first();
         if (!empty($rating)){
             $rating->rating = $rate;
         } else{
         $rating = new Rating;
         $rating->user_id = Auth::id();
         $rating->rating = $rate;
         }
         $movie->rating()->save($rating);

         // Calcualte the average rating and saving in movies
         $sumRatings = 0;
         $doAvgRatings =  $movie->rating;

         foreach($doAvgRatings as $rating){
             $sumRatings += $rating->rating;
         }
         $avgRating = 0;
         if(sizeof($doAvgRatings) != 0){
             $avgRating = $sumRatings / sizeof($doAvgRatings);
         }
         $movie->avgRating = $avgRating;
         $movie->save();
         return response()->json([
             'movieAvg' => $avgRating,
         ]);
        }
     }
}
