<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Session;
use App\Cart;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        $ooldcart = $request->session()->get('cart');
        $moviesHave = array();
        $cart = new Cart($ooldcart);
        $oldCart = unserialize($user->cart);

        if($oldCart && !empty($cart->items)){
            foreach($oldCart->items as $movies){
                if (!array_key_exists($movies['item']['id'], $cart->items)){
                   $cart->add($movies['item'], $movies['item']['id']);
                }
            }
        } else if(empty($cart->items)){
            $cart = $oldCart;
        }



        foreach($user->bill_headers as $billHeaders){
            foreach($billHeaders->bill_items as $billItems){
                array_push($moviesHave, $billItems->movie->id);

            }
        }

        if(!empty($cart->items)){
            foreach($cart->items as $movie){
                foreach($moviesHave as $moviesid){
                    if($movie['item']['id'] == $moviesid){
                        $cart->totalQty -= 1;
                        $cart->totalPrice -= $movie['item']['price'];
                        unset($cart->items[$movie['item']['id']]);
                    }
                }
            }
        }
        $request->session()->put('cart', $cart);

    }


    public function getRedirect(){
        $redirect = "/";
        if (Session::has('oldUrl')){
            $redirect = Session::get('oldUrl');
            Session::forget('oldUrl');
        }
        return $redirect;
    }
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = $this->getRedirect();

    }
}
