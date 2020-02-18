$(document)
.one('focus.autoExpand', 'textarea.autoExpand', function(){
    var savedValue = this.value;
    this.value = '';
    this.baseScrollHeight = this.scrollHeight;
    this.value = savedValue;
})
.on('input.autoExpand', 'textarea.autoExpand', function(){
    var minRows = this.getAttribute('data-min-rows')|0, rows;
    this.rows = minRows;
    rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 26);
    this.rows = minRows + rows;
});
$( document ).ready(function() {
    $('#addComment').on('click', 'button.comment-button', function (e) {
        e.preventDefault();
        var comment = $('textarea').val();
        var movieId = $('#movieId').val()

        $.ajax({
                method: "POST",
                url: "/comment",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    comment: comment,
                    movieId: movieId,
                },
                success: function (data){
                    if (data.error === 401){
                        var cmrespon =  $('#comment-response')
                        cmrespon.html("You must login for posting a comment").removeClass("msg-succes").addClass("msg-error")
                        cmrespon.fadeTo(2000, 0.5, function(){
                        cmrespon.stop(true)
                        cmrespon.html('');
                        cmrespon.css('opacity', '1')
                    });
                    } else if(data.error === 500){
                        var cmrespon =  $('#comment-response');
                        cmrespon.html("Your comment is empty").removeClass("msg-succes").addClass("msg-error")
                        cmrespon.fadeTo(2000, 0.5, function(){
                        cmrespon.stop(true)
                        cmrespon.html('');
                        cmrespon.css('opacity', '1')
                    });
                    }
                     else {
                    var countComments =  $('#count_comments');
                    countComments.html(parseInt(countComments.html()) + 1)
                    var content = '<div class="comment"> <hr class="hrlesmargin"><p class="minSize" class="bolder">'
                        + data.user_name + '<span class="postedAt">'
                        + data.created_at + '</span></p><p class="comment-text">'
                        + data.comment_text + '</p> <span class="nlikes">'
                        + 0 + '</span><button value = ' + data.id + ' class="like" id="give_like"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></button></div>'
                    $('.all-comments').prepend(content);
                    var cmrespon =  $('#comment-response');
                    cmrespon.html("Comment succesfully posted").removeClass("msg-error").addClass("msg-succes");
                    cmrespon.fadeTo(2000, 0.5, function(){
                        cmrespon.stop(true)
                        cmrespon.html('');
                        cmrespon.css('opacity', '1')
                    });
                    $('#comment-text').val('');
                    }
                }


            })

            $('textarea').removeData()
    });

});

$('.all-comments').on('click', '#give_like', function(e){
    e.preventDefault();
    var commentId = $(this);
        $.ajax({
                method: "POST",
                url: "/like_comment",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    commentId: commentId.val(),
                }
            })
            .done(function (msg) {
                console.log(msg);
                if (msg.error === 401){
                    window.location.href = "http://myfilms.com/login";
                } else {
                var commentIcon = commentId.children('i');
                if (msg === 1){
                    commentIcon.addClass("voted");
                } else {
                    commentIcon.removeClass("voted");
                }
                var commentCounter = commentId.siblings('span')
                commentCounter.html(parseInt(commentCounter.html()) + parseInt(msg))
                }
            });
    });
