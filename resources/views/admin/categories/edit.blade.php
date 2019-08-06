@extends('layouts.admin')

@section('content')

<h1>Edit Category</h1>
<div class="col-sm-6">
        {!! Form::model($categories, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $categories->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Category Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update Category', ['class'=>'btn btn-success col-sm-6']) !!}
            </div>
        {!! Form::close() !!}

        {!! Form::model($categories, ['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $categories->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>
        {!! Form::close() !!}
</div>


<div class="col-sm-6">
        @include('includes.error_form')
</div>
    
@stop