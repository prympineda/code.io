@extends('layouts.blog-post')


@section('content')
    



<!-- Blog Post -->

<!-- Title -->
<h1><a href="{{ route('admin.posts.index', $post->id) }}">{{ $post->title }}</a></h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at }}</p>

<hr>

<!-- Preview Image -->
<img height="250" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt="">

<hr>

<!-- Post Content -->
{{ $post->body }}
<hr>

<!-- Blog Comments -->

@if(Auth::check())
    <!-- Comments Form -->
    @if(Session::has('comment'))
    <p class="bg-info">{{ session('comment') }}</p>
    @endif
    <div class="well">
        {!! Form::open( ['method' => 'POST', 'action' => 'PostCommentController@store']) !!}
        <input type="hidden" name="post_id", value="{{ $post->id }}">
        <form role="form">
            <div class="form-group">
                {!! Form::label('body', 'Leave a Comment:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
            </div>
        </form>
        {!! Form::close() !!}
    </div>
@endif
<hr>

<!-- Posted Comments -->


@if(count($comments)>0)
    @foreach ($comments as $comment)
        @if ($post->id == $comment->post_id)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{ $comment->user->photo->file }}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->name }}
                <small>{{ $comment->created_at }}</small>
            </h4>
           <p>{{ $comment->body }}</p>
           <div class="comment-container">
                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                <div class="comment-container">
                    {!! Form::open( ['method' => 'POST', 'action' => 'CommentRepliesController@createreply']) !!}
                        <form role="form-group">
                            <div class="form-group">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    {!! Form::label('body', 'Reply:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
                            </div>
                            <div class="form-group">
                                    {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </form>
                    {!! Form::close() !!}
                </div>        
            </div> 

            <!-- Nested Comment -->

            @if(count($comment->commentreply) > 0) 
                @foreach ($comment->commentreply as $reply) 
                    @if ($reply->is_active == 1)
                    <div id="nested-comment" class="media">
                        <a class="pull-left" href="#">
                            <img height="64" class="media-object" src="{{ $comment->user->photo->file }}" alt="">
                        </a>
                        <div class="media-body"> 
                            <h4 class="media-heading">
                                <small>{{ $reply->updated_at->diffForHumans() }}</small>
                            </h4>
                       <p> {{ $reply->body }} </p>
                        </div>
                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                            <div class="comment-reply">
                                {!! Form::open( ['method' => 'POST', 'action' => 'CommentRepliesController@createreply']) !!}
                                <form role="form-group">
                                    <div class="form-group">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        {!! Form::label('body', 'Reply:') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                </form>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div> 
                    @endif    
                @endforeach
            @endif    
        <!-- End Nested Comment -->
        </div>
    </div>
       @endif
    @endforeach
@endif




@stop

@section('scripts')


    <script>
        $(".comment-container .toggle-reply").click(function(){

            $(this).next().slideToggle("slow");

        });
    </script>

    <script>
        $(".comment-reply-container .toggle-reply").click(function(){

            $(this).next().slideToggle("slow");

        });
    </script>


    
@stop