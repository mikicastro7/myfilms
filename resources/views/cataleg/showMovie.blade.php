@extends('layouts.main')

@section('content')
<link href="{{ asset('css/showMovie.css') }}" rel="stylesheet">
<div class="container">
    <h2 class="name">{{$movie->name}}</h2>
        <iframe width="100%" height="500px"
        src={{str_replace("watch?v=", "embed/", $movie->trailer) }}
        allowfullscreen="allowfullscreen">
        </iframe>
    <div class="info">
        <img src={{$movie->image}} alt="">
        <p class="description">{{$movie->description}}</p>
        <div class="info2">
                <p><span class="bolder">Price: </span>{{$movie->price}}€</p>
                <p class="category"><span class="bolder">Category: </span>{{$movie->category->name}}</p>
                <form action="/add-to-cart/{{$movie->id}}">
                    <button class="icon"><i class="fa fa-cart-plus fa-icon" aria-hidden="true"><p class="text">Add to cart</p></i></button>
                 </form>
                @include('includes.ratingForm')

                <p class="avg-rate"><span class="bolder">Avg rating:</span> <span id="avgRating">{{$movie->avgRating}}</span></p>
                <p class="my-rate"><span class="bolder">My rating:</span> <span id="myRating">{{$myRating}}</span>.00</p>
        </div>
    </div>
    @include('includes.comments')
</div>
<meta name="csrf-token" content="{!! csrf_token() !!}">
<script type="text/javascript" src="{{URL::asset('js/ratingAjax.js')}}"></script>
@stop
