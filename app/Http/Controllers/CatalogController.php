<?php

namespace App\Http\Controllers;
use DB;
use App\Movie;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\CommentLike;
use Illuminate\Support\Facades\Log;

class CatalogController extends Controller
{
    function index(Request $request){
        $movies = Movie::all();

        return view('welcome')->with(array('movies' => $movies, 'message' => $request->input('message'), 'messageType' => $request->input('messageType')));
    }
    function showMovie($id){
        $movie =  Movie::findOrfail($id);
        $comment = DB::table('comments')->where('movie_id', $id)->orderBy('created_at', 'desc')->get();

        //Take my rating from the database select by movie and user
        $myRating = Rating::where('movie_id', '=', $id)->where('user_id', '=', Auth::id())->first();
        if (empty($myRating)){
            $myRating = 0;
        } else {
            $myRating = $myRating->rating;
        }
        return view('cataleg.showMovie')->with(array('movie' => $movie, 'myRating' => $myRating, 'comments' => $comment));
    }
}
