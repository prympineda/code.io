@extends('layouts.admin')



@section('content')
<h1>Comments</h1>

{{--  @if ($post_id == Auth::user()->id)  --}}
@if(count($comments))
    <table class="table">
        <thead>
            <tr>
                <th>Post ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                @if($comment->post->user_id == Auth::user()->id)    
            <tr>
                <td>{{ $comment->post_id }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->user->email }}</td>
                <td><a href="{{ route('home.post', $comment->post->id) }}">{{ $comment->body }}</a></td>
                <td>
                    @if($comment->is_active == 1)
                        {!! Form::model($comment, ['method' => 'PATCH', 'action' => ['PostCommentController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">     
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-secondary']) !!}
                            </div>
                        {!! Form::close() !!}            
                    @else
                        {!! Form::model($comment, ['method' => 'PATCH', 'action' => ['PostCommentController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">     
                                {!! Form::submit('Approve', ['class'=>'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}        
                    @endif  
                </td>
                <td><a href="{{ route('admin.comment.replies.show', $comment->id) }}"><button class="btn-info">View Comments Reply</button></a></td>
                <td>
                    {!! Form::model($comment, ['method' => 'DELETE', 'action' => ['PostCommentController@destroy', $comment->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
                        </div>
                    {!! Form::close() !!}
                </td>
               
            </tr>
           
            @endif
        
            @endforeach
            {{--  @endif  --}}
        
        </tbody>
    </table>
     
@else

<h1 class="text-center">No Comments</h1>

@endif
    
@endsection