@extends('layouts.main')
@section('content')
<link href="{{ asset('css/showCart.css') }}" rel="stylesheet">

@if(Session::has('cart') && Session::get('cart') != [])
    @if(Session::get('cart')->items != null)
    <div class="container">
        <h1 class="cart-title">CART</h1>
        <div class="cart-display">
            <div class="products">

                    @foreach ($products as $product)
                    <div class="product">
                        <img src={{$product['item']['image']}} alt="">
                        <div class="name-description">
                            <a href= "/film/{{$product['item']['id']}}">{{$product['item']['name']}}</a>
                            <p>{{Str::limit($product['item']['description'], 310,' ...')}}</p>
                        </div>
                        <div class="price-buttons">
                            <h3>{{$product['item']['price']}}€</h3>
                            <form action="/remove-item-cart/{{$product['item']['id']}}">
                                <button><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach

            </div>
            <div class="total">
                <div class="display-total">
                    <h5>Total movies <span class="remark">{{count($products)}} </span></h5>
                    <h5>Total payment <span class="remark">{{number_format($totalPrice,2)}} €</span></h5>

                    <a href="/" class="button2">CONTINUE BUYING</a>
                    <form action="/checkout">
                        <button>PROCEED TO CHECKOUT</button>
                    </form>

                </div>

            </div>

        </div>

    </div>
    @endif
    @else
    <div class="container">
        <div class="cart-display">
            <div class="products">
                <h1 class="cart-title2">CART</h1>
                <h2 class="cart-empty-text">The cart is empty</h2>
            </div>

            <div style="height:80px" class="total">
                <div  class="display-total">
                    <a href="/" class="button2">CONTINUE BUYING</a>
                </div>
            </div>
        </div>
    </div>
    @endif

@stop

<style>
    body {
        position: relative;
      }

      body::after {
        content: '';
        display: block;
        height: 415px;
      }

      footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 415px;
      }

</style>


