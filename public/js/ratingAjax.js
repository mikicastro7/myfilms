

        $('.rating').on('click', 'input.star', function () {
            var rate = $(this).val();
            var movieId = $('#movieId').val()
            $.ajax({
                    method: "POST",
                    url: "/rating/rate",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        rate: rate,
                        movieId: movieId,
                    }
                })
                .done(function (msg) {
                    if (msg.error === 401){
                        window.location.href = "http://myfilms.com/login";
                    } else {
                    var avgRating = $('#avgRating');
                    avgRating.html(parseFloat(msg.movieAvg).toFixed(2));
                    var myRating = $('#myRating');
                    myRating.html(rate);
                    }
                })


        });
