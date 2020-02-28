@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Users
                            <a class="btn btn-primary pull-right" style="margin-top: 0px;margin-bottom: 5px"
                               href="{!! route('users.create') !!}">Add New</a>
                        </div>
                        <div class="card-body">
                            @include('users.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
      $('#roleId,#editRoleId').select2({
        width: '100%',
        placeholder: 'Select Role',
        minimumResultsForSearch: -1,
      })
      $(function () {
        $('#users_table').DataTable({
          processing: true,
          serverSide: true,
          'order': [[0, 'desc']],
          ajax: {
            url: '{!! url(route('users.index'))  !!}',
          },
          columnDefs: [
            {
              'targets': [0, 4],
              'orderable': false,
              'className': 'text-center',
              'width': '5%',
            },
          ],
          columns: [
            {
              data: function (row) {
                if (row) {
                  return '<img class="assignee__avatar" style="width: 35px;" src="' +
                    row.image_path +
                    '" data-toggle="tooltip" title="' + row.name +
                    '">'
                } else {
                  return ''
                }
              },
              name: 'name',
            },
            {
              data: 'name',
              name: 'name',
            },
            {
              data: 'email',
              name: 'email',
            },
            {
              data: 'phone',
              name: 'phone',
            },
            {
              data: function (row) {
                return '<a title="Edit" class="btn action-btn btn-primary btn-sm edit-btn mr-1" href="{{url('/users')}}/' + row.id + '/edit" >' +
                  '<i class="fa fa-pencil" style="font-size:15px;color:white"></i>' + '</a>' +
                  '<a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="' +
                  row.id + '">' +
                  '<i class="fa fa-trash-o" style="font-size:15px;color:white"></i></a>'
              }, name: 'id',
            },
          ],
        })
      })

      // open delete confirmation model
      $(document).on('click', '.delete-btn', function (event) {
        let userId = $(event.currentTarget).data('id');
        deleteItem('{{url('users')}}/' + userId, '#users_table', 'User');
      });
    </script>
@endsection
