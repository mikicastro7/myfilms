<link href="{{ asset('css/peliculas.css') }}" rel="stylesheet">
<div class="container">
@if (!empty($message))
<div class="alert alert-{{$messageType}}" role="alert">
    <span>{{$message}}</span>
</div>
@endif
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
                            <a href="/add-to-cart/{{$movie->id}}" class="icon"><i class="fa fa-cart-plus fa-icon" aria-hidden="true"></i></a>
                            <a href="/film/{{$movie->id}}"><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i></a>
                        </div>

                    </div>
        </div>
        @endforeach
    </div>
</div>

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

</style>

<script>
var cmrespon =  $('.alert');
cmrespon.fadeTo(5000, 0.8, function(){
    cmrespon.stop(true)
    cmrespon.css('opacity', '1')
    cmrespon.css('display', 'none')
});

</script>

