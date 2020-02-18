@extends('layouts.main')
@section('content')
<link href="{{ asset('css/peliculas.css') }}" rel="stylesheet">
@if(count($movies) > 0)
<div class="container">
    <h1 class="myfilms-title">MYFILMS</h1>
    <div class="movies">
        @foreach ($movies as $movie)
        <div class="movie cards-hover">

                    <img src={{$movie->image}}
                        alt="">
                    <h2>{{Str::limit($movie->name, 20,'...')}}</h2>
                    <div class="card-hover">
                            <h3>{{$movie->name}}</h3>
                            <p>{{Str::limit($movie->description, 75,'...')}} </p>
                            <ul>
                                <li><span>Price: {{$movie->price}}</span></li>
                                <li><span>Genere: {{$movie->category->name}}</span></li>
                                @if($movie->avgRating != 0)
                                <li>Rating:&nbsp;
                                        @for ($i = 0; $i < $movie->avgRating; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                </li>
                                @endif
                            </ul>
                        <div class="icons">
                            <a href="{{$movie->trailer}}" class="icon"><i class="fa fa-play fa-icon" aria-hidden="true"></i></a>
                            <a href="/film/{{$movie->id}}"><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i></a>
                        </div>

                    </div>
        </div>
        @endforeach
    </div>
</div>
@else
<link href="{{ asset('css/showCart.css') }}" rel="stylesheet">
<div class="container">
    <div class="cart-display">
        <div class="products">
            <h1 class="cart-title2">myfilms</h1>
            <h2 class="cart-empty-text">You don't have any movie yet</h2>
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
      .alert{
          margin-bottom: -6px;
          margin-top: -29px;
          padding-top: 5px;
          padding-bottom: 5px;
      }
      .myfilms-title{
          margin-top: -10px;
          text-align: center;
          font-weight: bolder;
          font-family: 'Roboto', sans-serif;
       }

    </style>
