@extends('dashboard')
@section('title')
    Apps
@endsection
@can('add-create')
    @section('header')
        <a href="#" class="btn btn-primary addModal"><i class="fa-solid fa-plus"></i>Add</a>
    @endsection
@endcan
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('app.table')
                </div>
            </div>
        </div>
        @can('add-create')
            @include('app.create')
        @endcan
        @can('app-edit')
            @include('app.edit')
        @endcan
    </div>
@endsection
@section('scripts')
    <script>
        let appUrl = "{{ route('apps.index') }}";

        let dashboardUrl = "{{ route('purchage') }}";

        let setCookieUrl = "{{ route('set_cookie') }}";
        let appSaveUrl = "{{ route('apps.store') }}";
        let permissionData = @json($permission);
        // console.log(permissionData)
        $(document).ready(function() {
            if (window.location.href.indexOf('reload') == -1) {
                window.location.replace(window.location.href + '?reload');
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tableName = '#appTbl';
            var tbl = $(tableName).DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: {
                    url: appUrl
                },
                columnDefs: [{
                    'targets': [2],
                    'orderable': false,
                    'width': '8%'
                }, ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    // {
                    //     data: function data(row) {
                    //         let deltebtn = null;
                    //         if (permissionData.includes("app-id-" + row.id)) {
                    //             deletebtn =
                    //                 `<a title="${row.name}" class="btn btn-sm app-btn" data-name="${row.name}" data-id="${row.id}" href='#' style="font-size: 1.005rem;">${row.name}</a>`
                    //         } else {
                    //             deletebtn = `<a class="btn btn-sm app-btn" style="font-size: 1.005rem;">${row.name}</a>`
                    //         }

                    //         return `${deletebtn}`
                    //     },
                    //     name: 'name'
                    // },
            //         {
            //             data: function data(row) {
            //                 let deltebtn = null;
            //                 return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="#">
            // <i class="fa fa-edit"></i>
            //     </a> <a title="Edit" class="btn btn-success btn-sm app-btn" data-id="${row.id}" href="#">
            //         <i class="fa-solid fa-diamond-turn-right"></i>
            //     </a> <a title="Edit" class="btn btn-sm delete-btn" data-id="${row.id}" href="#">
            //         <i class="fa-solid fa-trash"></i>
            //     </a>`
            //             },
            //             name: 'id',
            //             orderable: false,
            //             searchable: false
            //         }
                    {
                        data: function data(row) {
                            let deltebtn = null;
                            if (permissionData.includes("app-id-"+ row.id)) {
                                deletebtn = `<a title="${row.name}" class="btn btn-sm delete-btn delete2-btn" data-name="${row.name}" data-id="${row.id}" href='#'>
                        <i class="fa fa-sign-in"></i>
                </a>`
                            } else {
                                deletebtn = ''
                            }

                            return `@can('app-edit')<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="#">
            <i class="fa fa-edit"></i>
                </a> @endcan
                        ${deletebtn}

                `
                        },
                        name: 'id',
                    }
                ]
            });

            $(document).on('click', '.addModal', function() {
                $('#addModal').appendTo('body').modal('show');
            });

            $(document).on('submit', '#addForm', function(e) {
                e.preventDefault();
                if ($('#name').val() == "") {
                    displayErrorMessage('Name field is required.');
                    return false;
                }
                $.ajax({
                    url: appSaveUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        if (result.success) {
                            $('#addModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(result) {
                        displayErrorMessage(result.responseJSON.message);
                    },
                });
            });

            $(document).on('click', '.edit-btn', function(event) {
                let appId = $(event.currentTarget).attr('data-id');
                renderData(appId);
            });
            window.renderData = function(id) {
                $.ajax({
                    url: appUrl + '/' + id + '/edit',
                    type: 'GET',
                    success: function(result) {
                        if (result.success) {
                            $('#edit_name').val(result.data.name);
                            $('#appId').val(result.data.id);
                            $('#editModal').appendTo('body').modal('show');
                        }
                    },
                    error: function(result) {
                        displayErrorMessage(result.responseJSON.message);
                    },
                });
            };

            $(document).on('submit', '#editForm', function(e) {
                e.preventDefault();
                if ($('#edit_name').val() == "") {
                    displayErrorMessage('Name field is required.');
                    return false;
                }
                var id = $('#appId').val();
                $.ajax({
                    url: appUrl + '/' + id,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        if (result.success) {
                            displaySuccessMessage(result.message);
                            $('#editModal').modal('hide');
                            $(tableName).DataTable().ajax.reload(null, false);
                        }
                    },
                    error: function(result) {
                        displayErrorMessage(result.responseJSON.message);
                    },
                });
            });
            $(document).on('click', '.delete2-btn', function(event) {
                let appId = $(event.currentTarget).attr('data-id');

                let appName = $(event.currentTarget).attr('data-name');

                $.ajax({
                    url: setCookieUrl + '/' + appId + '/' + appName,
                    type: 'GET',
                    success: function(result) {
                        location.href = dashboardUrl
                    },
                    error: function(result) {
                        displayErrorMessage(result.responseJSON.message);
                    },
                });
            });

        //     $(document).on('click', '.delete2-btn', function(event) {
        //     var appId = $(event.currentTarget).attr('data-id');
        //     deleteItem(appUrl + '/' + appId, tableName, 'App');
        // });






            $(document).on('click', '.app-btn', function(event) {
                let appId = $(event.currentTarget).attr('data-id');

                let appName = $(event.currentTarget).attr('data-name');

                $.ajax({
                    url: setCookieUrl + '/' + appId + '/' + appName,
                    type: 'GET',
                    success: function(result) {
                        location.href = dashboardUrl
                    },
                    error: function(result) {
                        displayErrorMessage(result.responseJSON.message);
                    },
                });
            });
        });
    </script>
@endsection
