<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Movie;
use App\Category;
use Illuminate\Support\Facades\Log;

class AdminMoviesController extends Controller
{
    public function Movies(){
        return view('admin.moviesAdmin');
    }
    public function getMovies(){
        return Datatables::of(Movie::query())->make(true);
    }
    public function getCategories(){
        $categories = [];
        $cats = Category::all();
        foreach ($cats as $cat){
            $categories[] = [
                'category_id' => $cat->id,
                'name' => $cat->name,
            ];
        }
        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function addMovie(Request $request){
        $movie = new Movie;
        $movieName = $request->input('name');
        $movieDescription = $request->input('description');
        $moviePrice = $request->input('price');
        $movieImage = $request->input('image');
        $movieTrailer = $request->input('trailer');
        $movieCategorysplit = explode(" ",$request->input('category'));
        $movieCategory = $movieCategorysplit[count($movieCategorysplit) - 1];
        if($movieName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($movieDescription == null){
            return response()->json(['error' => "description field it's empty"], 500);
        }
        if($moviePrice == null){
            return response()->json(['error' => "price field it's empty"], 500);
        }
        if($movieImage == null){
            return response()->json(['error' => "Image field it's empty"], 500);
        }
        if($movieTrailer == null){
            return response()->json(['error' => "trailer field it's empty"], 500);
        }

        $movie->name = $movieName;
        $movie->description = $movieDescription;
        $movie->price = $moviePrice;
        $movie->image = $movieImage;
        $movie->trailer = $movieTrailer;
        $movie->category_id = $movieCategory;

        $movie->save();

        $notification = array(
            'message' => 'Movie Added succesfully!',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);

    }

    public function deleteMovie(Request $request){

        $movie = Movie::find($request->movie_id);
        $movie->delete();
        $notification = array(
            'message' => 'Movie deleted',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function editMovie(Request $request){
        $movie = Movie::find($request->movie_id);

        $movieName = $request->input('name');
        $movieDescription = $request->input('description');
        $moviePrice = $request->input('price');
        $movieImage = $request->input('image');
        $movieTrailer = $request->input('trailer');
        $movieCategorysplit = explode(" ",$request->input('category'));
        $movieCategory = $movieCategorysplit[count($movieCategorysplit) - 1];
        if($movieName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($movieDescription == null){
            return response()->json(['error' => "description field it's empty"], 500);
        }
        if($moviePrice == null){
            return response()->json(['error' => "price field it's empty"], 500);
        }


        $movie->name = $movieName;
        $movie->description = $movieDescription;
        $movie->price = $moviePrice;
        if ($movieImage != null){
            $movie->image = $movieImage;
        }
        if ($movieTrailer != null){
            $movie->trailer = $movieTrailer;
        }
        $movie->category_id = $movieCategory;
        $movie->save();

        $notification = array(
            'message' => 'Movie Edited succesfully!',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);

    }
}


