<link href="{{ asset('css/ratingStyle.css') }}" rel="stylesheet">
<form class="rate-form" id="addStar" method="POST">
    <input id="movieId" type="hidden" value="{{$movie->id}}">

            <div class="rating">
                <strong>Rate it: </strong>
                <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
                <label class="star star-5" for="star-5"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                <label class="star star-4" for="star-4"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                <label class="star star-3" for="star-3"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                <label class="star star-2" for="star-2"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                <label class="star star-1" for="star-1"><i class="fa fa-star" aria-hidden="true"></i></label>
            </div>
    </form>
