@extends('layouts.admin')


@section('content')
    
<h1>Media</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created_at</th>
                
            </tr>
        </thead>
        <tbody>
            @if($photos)
             @foreach ($photos as $photo)
            <tr>
                <td>{{ $photo->id }}</td>
                <td><img height="50" src="{{ $photo->file }}" alt=""></td>
                <td>{{ $photo->created_at ? $photo->created_at : 'no date' }}</td>
                <td>  {!! Form::model($photo, ['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id], 'files'=>true]) !!}
                    <div class="form-group">    
                            {!! Form::submit('Delete Photo', ['class'=>'btn btn-danger col-sm-6']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
             @endforeach
            @endif
        </tbody>
    </table>




@stop