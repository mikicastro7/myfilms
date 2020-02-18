@extends('layouts.main')
@section('content')
<h1 class="title">Users Admin</h1>
<div class="container">
  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="addUserForm">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label> Name </label>
                    <input id="form-name" type="text" class="form-control" name="name" placeholder="enter name">
                </div>
                <div class="form-group">
                    <label> Type </label>
                    <input id="form-type" type="number" class="form-control" name="type" placeholder="enter type">
                </div>
                <div class="form-group">
                    <label> email </label>
                    <input id="form-email" type="text" class="form-control" name="email" placeholder="enter email">
                </div>
                <div class="form-group">
                    <label> password </label>
                    <input id="form-password" type="password" class="form-control" name="password" placeholder="enter password">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Register user</button>
        </div>
      </div>
    </div>
  </div>

    <!--Edit user modal Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label> Name </label>
                        <input id="form-name-edit" type="text" class="form-control" name="name" placeholder="enter name">
                    </div>
                    <div class="form-group">
                        <label> Type </label>
                        <input id="form-type-edit" type="number" class="form-control" name="type" placeholder="enter type">
                    </div>
                    <div class="form-group">
                        <label> email </label>
                        <input id="form-email-edit" type="text" class="form-control" name="email" placeholder="enter email">
                    </div>
                    <div class="form-group">
                        <label> password </label>
                        <input id="form-password-edit" type="password" class="form-control" name="password" placeholder="enter password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit User</button>
            </div>
          </div>
        </div>
      </div>

  <!--Delete user modal Modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete the user.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary">Cancel</button>
          <button type="submit" class="btn btn-primary" data-dismiss="modal">Accept</button>
        </div>
      </div>
    </div>
  </div>


    <div class="row">
        <div class="col text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add User
              </button>
        </div>
      </div>

    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
    </table>
</div>


<script type="text/javascript" src="{{URL::asset('js/userAdmin.js')}}"></script>
@stop

<style>
    body {
        position: relative;
      }

    body::after {
        content: '';
        display: block;
        height: 415px;
      }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 415px;
      }
    .title{
        margin-top: -15px;
        text-align: center;
        font-weight: bolder;
        margin-bottom: 20px;
        font-family: 'Roboto', sans-serif;
    }
    .dataTables_wrapper{
        margin-bottom: 38px;
    }
    .table-btn{
        width: 100%;
        margin: auto;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }

</style>
