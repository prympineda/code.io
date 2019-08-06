@extends('layouts.admin')


@section('content')
    <h1>Create Post</h1>

    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files'=>true]) !!}
  
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>7]) !!}
    </div>
    <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', [''=>'Choose Category'] + $category, 0, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>


{!! Form::close() !!}

@include('includes.error_form')


    @stop