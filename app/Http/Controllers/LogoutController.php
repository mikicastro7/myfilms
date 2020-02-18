<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LogoutController extends Controller
{
    public function logout(Request $request){
        $cart = $request->session()->get('cart');
        $cartSerializ = serialize($cart);

        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->cart = $cartSerializ;
        $user->save();

        $request->session()->flush('cart');
        Auth::logout();

        return  redirect()->action('CatalogController@index');
    }
}
