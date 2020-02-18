<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class MyfilmsController extends Controller
{
    function showMyFilms ($id){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $movies = array();

        foreach($user->bill_headers as $billHeaders){
            foreach($billHeaders->bill_items as $billItems){
                array_push($movies, $billItems->movie);
            }
        }


        return view('myfilms.myfilms')->with(array('movies' => $movies));
    }
}
