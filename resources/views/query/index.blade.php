@extends('dashboard')
@section('title')
    Query
@endsection
{{-- @section('header')
    @can('permission-create')
        <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a>
        </div>
    @endcan
@endsection --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    {{-- <h3>Admin</h3> --}}
                    {{-- @php
                        dd($roles);
                    @endphp --}}
                    <div class="table-responsive tab-pane" id="queryTab" role="tabpanel">
                        <table class="table table-striped" id="queryTable">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('User_id') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    {{-- <th scope="col">{{ __('Description') }}</th> --}}
                                    <th scope="col">{{ __('Action') }}</th>
                                    {{-- <th scope="col">{{ __('Role') }}</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let queryUrl = "{{ route('get_query') }}";
        var tableName = '#queryTable';
        var tbl = $(tableName).DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                // {
                //     data: function data(row) {
                //         return row?.description == null ? 'N/A' : row?.description;
                //     },
                //     name: 'description'
                // },
                {
                    data: function data(row) {
                        var url = queryUrl + '/' + row.id;
                        return `<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/show">
                <i class="fa fa-edit"></i>
                    </a> <a type="button" title="Delete" class="btn btn-sm delete-btn text-white" data-id="${row.id}" href="${url}">
               <i class="fa-solid fa-trash"></i></a>`
                    },
                    name: 'id'
                }
            ]
        });

        // $(document).on('click', '.delete-btn', function(event) {
        //     console.log('queryId');
        //     var queryId = $(event.currentTarget).attr('data-id');
        //     deleteItem(queryUrl + '/' + queryId, tableName);
        // });


    </script>
@endsection
