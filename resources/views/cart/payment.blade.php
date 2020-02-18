@extends('layouts.main')
@section('content')
<link href="{{ asset('css/showCart.css') }}" rel="stylesheet">
    <div class="container">
        <h1 class="cart-title">CONFIRM ORDER</h1>
        <div class="cart-display">
            <div class="products">
                <h2 class="title-display border-bottom-title">Payment method</h2>

                    <form class="payment-methods">
                        <div class="payment card2">
                            <label for="card" class="method">
                                <img class="pay-img" src="http://uniemprendia.es/wp-content/uploads/2018/10/Visa-MasterCard-1024x393.png" alt="">
                                <div class="center-text">
                                    <input id="card" type="radio" name="payment-method" value="creditcard"><span> Pay with credit card</span>
                                </div>

                            </label>
                        </div>
                        <div class="payment paypal">
                            <label for="paypal" class="method">
                                <img class="pay-img" src="https://blog.casadellibro.com/wp-content/uploads/2019/06/paypal-784404_1280-1024x512.png" alt="">
                                <div class="center-text">
                                    <input id="paypal" type="radio" name="payment-method" value="paypal"><span> Pay with paypal</span>
                                </div>

                            </label>
                        </div>
                      </form>
                      <h2 class="title-display border-top-title">Confirm movies</h2>

                @foreach ($products as $product)
                    <div class="product">
                        <img src={{$product['item']['image']}} alt="">
                        <div class="name-description">
                            <a href= "/film/{{$product['item']['id']}}">{{$product['item']['name']}}</a>
                            <p>{{Str::limit($product['item']['description'], 310,' ...')}}</p>
                        </div>
                        <div class="price-buttons">
                            <h3>{{$product['item']['price']}}€</h3>
                            <form action="/remove-item-cart/checkout/{{$product['item']['id']}}">
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
                    <button id="confirmOrder">CONFIRM ORDER</button>
                    <span class="confirm-error-message" id="confirm-response"></span>
                </div>

            </div>

        </div>
    </div>
@stop

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
$(document).ready(function() {

// Radio box border
$('.method').on('click', function() {
  $('.method').removeClass('blue-border');
  $(this).addClass('blue-border');
});

$('#confirmOrder').on('click', function(){
    if($('#paypal').is(':checked')) {
        window.location.href = "http://myfilms.com/checkout/paypal";
    }
    else if ($('#card').is(':checked')) {
        window.location.href = "http://myfilms.com/checkout/card";
    } else{
        var cmrespon =  $('#confirm-response')
        cmrespon.html("You must select a payment method")
        cmrespon.fadeTo(2000, 0.5, function(){
        cmrespon.stop(true)
        cmrespon.html('');
        cmrespon.css('opacity', '1')
        });
    }
})

});


</script>

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


