@extends('layouts.admin')


@section('content')
@if(Session::has('deleted_user'))
<p class="bg-danger">{{ session('deleted_user') }}</p>
@endif
<h1>Post</h1>
<table class='table'>
    <thead>
        <tr>
            <th>Photo</th>
            <th>ID</th>
            <th>Owner</th>
            <th>Category ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
    </thead>
    <tbody>
        @if($posts)
            @foreach ($posts as $post)
                <tr>
                    <td><img height="50"src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td> <a href="{{ route('admin.posts.edit',  $post->id) }}">{{ $post->title }}</a></td>
                    <td><a href="{{ route('home.post', $post->slug) }}">{{ $post->body }}</a></td>
                    <td>{{ $post->created_at->diffforhumans() }}</td>
                    <td>{{ $post->updated_at->diffforhumans() }}</td>
                </tr>  
            @endforeach
        @endif    
    </tbody>  

</table>

<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        {{ $posts->render() }}
    </div>
</div>
@stop