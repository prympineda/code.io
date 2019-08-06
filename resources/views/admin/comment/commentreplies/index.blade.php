@extends('layouts.admin')


@section('content')



@if(count($replies))
<h1>Comment Reply</h1>
<table class="table">
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($replies as $reply)
            {{--  @if($reply->post->user_id == Auth::user()->id)      --}}
        <tr>
            <td>{{ $reply->comment_id }}</td>
            <td>{{ $reply->user->name }}</td>
            <td>{{ $reply->user->email }}</td>
            <td><a href="{{ route('home.post', $reply->comment->post->id) }}">{{ $reply->body }}</a></td>
            <td>
                @if($reply->is_active == 1)
                    {!! Form::model($reply, ['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-group">     
                            {!! Form::submit('Un-approve', ['class'=>'btn btn-secondary']) !!}
                        </div>
                    {!! Form::close() !!}            
                @else
                    {!! Form::model($reply, ['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                        <input type="hidden" name="is_active" value="1">
                        <div class="form-group">     
                            {!! Form::submit('Approve', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}        
                @endif    
            </td>
            <td>
                {!! Form::model($reply, ['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
                    </div>
                {!! Form::close() !!}
            </td>
           
        </tr>
       
        {{--  @endif  --}}
    
        @endforeach
  
    
    </tbody>
</table>
 
@else

<h1 class="text-center">No Comment Reply</h1>

@endif
@endsection