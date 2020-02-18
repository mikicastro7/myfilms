<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CommentLike;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function postComment(Request $request){

        $sessioIniciada = Auth::id();
        if(empty($sessioIniciada)){

            return response()->json(['error' => 401]);
        } else{
            if ($request->comment == null){
                return response()->json(['error' => 500]);
            }
        $comment = new Comment;
        $comment->movie_id = $request->movieId;
        $comment->comment_text = $request->comment;
        $comment->user_id = Auth::id();
        $comment->user_name = Auth::user()->name;
       // $comment->likes = 0;
        $comment->save();
        return response()->json($comment);
        }
    }
    function likeComment(Request $request){
        $sessioIniciada = Auth::id();
        if(empty($sessioIniciada)){

            return response()->json(['error' => 401]);
        } else {
        $action = 0;
        $commentLike =  CommentLike::where('comment_id', '=', $request->commentId)->where('user_id', '=', Auth::id())->first();
        if(!empty($commentLike)){
            $commentLike->delete();
            $action = -1;
        } else{
            $commentLike = new CommentLike;
            $commentLike->user_id = Auth::id();
            $commentLike->comment_id = $request->commentId;
            $commentLike->save();
            $action = 1;
        }

        return response()->json($action);
        }
    }
}
