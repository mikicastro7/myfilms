<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Cart;
use Illuminate\Contracts\Session\Session;
use App\Bill_header;
use App\Bill_item;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    function showCart(Request $request){
        if (!$request->session()->has('cart')) {
            return view('cart.showCart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('cart.showCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    function addToCart(Request $request, $id){
        $movie =  Movie::findOrfail($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart',): null;
        $cart = new Cart($oldCart);
        $user_id = Auth::id();
        $user = User::find($user_id);
        $haveFilm = 0;

        if(!empty($user_id)){
            foreach($user->bill_headers as $billHeaders){
                foreach($billHeaders->bill_items as $billItems){
                    if($id == $billItems->movie->id){
                        $haveFilm = 1;
                    }
                }
            }
        }
        if ($haveFilm == 1){
            $message = "You alredy have that film";
            $messageType = "warning";
        }
        else if(!$cart->items == null){
            if (array_key_exists($id, $cart->items)){
                $message = "film already added at the cart";
                $messageType = "warning";
            } else{
                $cart->add($movie, $movie->id);
                $message = "film added successfully to the cart";
                $messageType = "success";
            }
        } else {
            $cart->add($movie, $movie->id);
            $message = "film added successfully to the cart";
            $messageType = "success";
        }
        $request->session()->put('cart', $cart);
        return redirect()->action('CatalogController@index', ['message' => $message, 'messageType' => $messageType]);
    }
    function getRemoveItem(Request $request, $id){
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart',): null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->action('CartController@showCart');
    }
    function getRemoveItemCheckout(Request $request, $id){
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart',): null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->action('CartController@payment');
    }

    function payment(Request $request){
        if (!$request->session()->has('cart')) {
            return view('cart.showCart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        return view('cart.payment', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    function cardPayment(Request $request){
        if (!$request->session()->has('cart')) {
            return view('cart.showCart');
        }
        return view('payment-methods.card');
    }
}
