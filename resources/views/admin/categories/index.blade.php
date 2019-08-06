@extends('layouts.admin')

@section('content')
    <h1>Category</h1>
        <div class="col-sm-6">
                {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Category Name:') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
        </div>
        <div class="col-sm-6">
                <table class="table", class=>
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories)
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
        </div>

        <div class="row">
                @include('includes.error_form')
        </div>

@stop