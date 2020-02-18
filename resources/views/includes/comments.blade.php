<link href="{{ asset('css/commentsstyle.css') }}" rel="stylesheet">
<hr>
<div class="comments-container">
        <h4 class="comments-title">COMMENTS</h1>
        <h5><span id="count_comments">{{count($movie->comment)}}</span> Comments</h5>
            <form id="addComment" method="POST">
                    <input id="movieId" type="hidden" value="{{$movie->id}}">
                    <textarea id="comment-text" class='autoExpand' rows='1' data-min-rows='1' placeholder='Cooment Here'></textarea>
                    <div class="public-comment">
                            <span id="comment-response"></span>
                            <button class="comment-button">COMMENT</button>
                    </div>
            </form>
            <div class="all-comments">
                @php
                $orderedComments = $movie->comment->sortByDesc('created_at');
                @endphp
            @foreach ($orderedComments as $comment)

                <div class="comment">
                        <hr class="hrlesmargin">
                        <p class="minSize" class="bolder">{{$comment->user_name}}<span class="postedAt">{{$comment->created_at}}</span></p>
                        <p class="comment-text">{{$comment->comment_text}}</p>
                <span class="nlikes">{{count($comment->commentLikes)}}</span>

                @foreach($comment->commentLikes as $commentLikes)
                @if($commentLikes->user_id == Auth::id())
                @php ($class = 'voted')
                @endif

                @endforeach
                <button value={{$comment->id}} id="give_like" class="like">
                <i class="fa fa-thumbs-up {{$class ?? ''}}" aria-hidden="true"></i></button>
                {{$class = ""}}
            </div>
            @endforeach
        </div>
</div>

<script type="text/javascript" src="{{URL::asset('js/comments.js')}}"></script>

