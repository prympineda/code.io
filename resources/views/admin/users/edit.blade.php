@extends('layouts.admin')


@section('content')
    
<h1>Edit User</h1>

<div class="row">
        <div class="col-sm-3">
          <img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
        </div>

    <div class="col-sm-9">
      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files'=>true]) !!}
                <div class="form-group">       
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}      
                </div>
                <div class="form-group">       
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}      
                </div>
                <div class="form-group">       
                        {!! Form::label('role_id', 'Role:') !!}
                        {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}      
                </div>
                <div class="form-group">       
                        {!! Form::label('is_active', 'Status:') !!}
                        {!! Form::select('is_active', array(1 => 'Active', 0=> 'Not Active'), null, ['class'=>'form-control']) !!}      
                </div>
                <div class="form-group">       
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password',['class'=>'form-control']) !!}      
                </div>
                <div class="form-group">       
                        {!! Form::label('photo_id', 'Photo:') !!}
                        {!! Form::file('photo_id',['class'=>'form-control']) !!}      
                </div>
                {!! Form::submit('Update User', ['class'=>'btn btn-success col-sm-6']) !!} 
                {{-- <div class="form-group">
                                
                  <button class="btn btn-success col-sm-6" data-toggle="modal" data-target="#edit_user_confirmation">Edit User</button>
                </div>    --}}
        {!! Form::close() !!}
      
        {!! Form::model($user, ['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id], 'files'=>true]) !!}
        <div class="form-group">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>
        {!! Form::close() !!}
        


    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_user_confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Save changes?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
         <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{--  End Modal  --}}


<div class="row">
@include('includes.error_form')
</div>
@stop