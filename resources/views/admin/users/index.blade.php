@extends('layouts.admin')


@section('content')

@if(Session::has('deleted_user'))
<p class="alert alert-danger text-center fade in top-space">{{ session('deleted_user') }}</p>
@endif


@if(Session::has('updated_user'))
<p class="alert alert-success text-center fade in top-space">{{ session('updated_user') }}</p>
@endif


<h1>Users</h1>


    {{--  @include('includes.success')  --}}

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<table id='datatable' class="table table-bordered table-striped table-dark">
  <thead>
    <tr>
      <th>Photo</th>
      <th>User ID</th>
      <th>Role</th>
      <th>Name</th>
      <th>E-mail</th>
      <th>Status</th>
      <th>Created_at</th>
      <th>Updated_at</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @if ($users)
    @foreach ($users as $user)
    <tr>
      <td><img height="50" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
      <td>{{ $user->id }}</td>
      <td>{{ $user->role->name }}</td>
      <td>
        {{--  <a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }} --}}
        <!-- Button trigger modal -->
        {{--  <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#edit_user_Modal">  --}}
        {{ $user->name }}
        {{--  </button>  --}}


        {{--  </a>  --}}
      </td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
      <td>{{ $user->created_at->diffForHumans() }}</td>
      <td>{{ $user->updated_at->diffForHumans() }}</td>
      {{--  <td><button type="button" class="btn btn-primary" data-name="{{ $user->name }}" data-role="{{ $user->role->name }}" data-email="{{ $user->email }}"  data-toggle="modal"  data-target="#user_edit_Modal">Edit</button></td>  --}}
      {{-- <td><a href="{{ route('admin.users.index', $user->id) }}"  data-toggle="modal" data-target="#edit_user_Modal{{ $user->id }}">Edit</a></td> --}}
      <td><a href="{{ route("admin.users.edit", $user->id) }}" class="btn btn-info">Edit</a>
      <button class="btn btn-danger" data-toggle="modal" data-user_id="{{ $user->id }}" data-target="#admin_users_delete_confirmation"><i class="fa fa-times"></i></button></td>
    </tr>
    @endforeach
    @endif
  </tbody>



  {{--  <!-- Start Edit Modal -->  --}}
  {{--  <div class="modal fade" id="user_edit_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group">
              <label>Role</label>
              <select id="role_id" name="role_id" class="form-control" >
                @foreach ($roles as $role)
                  <option @if($role->id == $user->role_id) selected @endif value="{{ $role->id}}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="name">Email address</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
              <small id="emailHelp" class="form-text text-muted">Well never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
            </div>
            <fieldset class="form-group">
              <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1"
                      checked>
                    <label class="form-check-label" for="gridRadios1">
                      First radio
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                      Second radio
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </form>
       
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
  </div>
  --}}

{{-- 
  <script type="text/javascript">
    $(document).ready(function(){
                  var table = $('#datatable').DataTable();
                  table.on('click', '.edit', function(){
                    $tr = $(this).closest('tr');
                    if ($($tr).hasClass('child')){
                      $tr = $tr.prev('.parent');
                    }
                    var data = table.row($tr).data();
                    console.log(data);
  
                    $('#role').val(data[1]);
                    $('#name').val(data[3]);
                    $('#email').val(data[4]);
                    $('#password').val(data[5]);
                    $('#is_active').val(data[2]);
  
  
                    $('#editForm').attr('action', '/admin/user/'+data[0]);
                    $('#edit_user_Modal').modal('show');
                  });
                });
  
  </script> --}}
   {{-- <!-- End Edit Modal -->  --}}













</table>
  

<!-- Modal -->
<div class="modal modal-danger fade" id="admin_users_delete_confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        <h5 class="modal-title text-center" id="exampleModalLabel">Delete User</h5>
        
      </div>
      {{-- <form action="{{ route('admin.users.destroy', 'test') }}" method="POST">
        {{ method_field('delete') }}
        {{ csrf_field() }}
      </form> --}}
      <div class="modal-body">
        <p> Are you sure you want to DELETE this user?</p>
        {{-- <input type="hidden" name="user_id" id="user_id" value=""> --}}
      </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
    
        <form action="{{ route('admin.users.destroy', 'test') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $user->id }}" />
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{--  End Modal  --}}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>












@endsection