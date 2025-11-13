@extends('dashboard')
@section('title')
    Permission
@endsection
@section('header')
    @can('permission-create')
        <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a>
        </div>
    @endcan
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    {{-- <h3>Admin</h3> --}}
                    {{-- @php
                        dd($roles);
                    @endphp --}}
                    <div class="table-responsive tab-pane" id="inAppPurchase" role="tabpanel">
                        <table class="table table-striped" id="inAppPurchasePlanTbl">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('User ID') }}</th>
                                    <th scope="col">{{ __('User Name') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Role') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
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
        let planUrl = "{{ route('permission') }}";
        var tbl = $('#inAppPurchasePlanTbl').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: planUrl,
                data: {
                    'category': '1'
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: function data(row) {
                        let roleName = row.user_role.length > 0 ?  row.user_role[0].name : `N/a`;
                        return '<span class="badge badge-secondary">' + roleName  + '</span>';
                    },
                    name: 'name',
                },
                {
                    data: function data(row) {
                        var url = planUrl + '/' + row.id;
                        return `@can('permission-edit')<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
                <i class="fa fa-edit"></i>
                    </a> @endcan @can('permission-delete') <a title="Delete" class="btn btn-sm delete-btn delete-1 text-white" data-id="${row.id}" href="#">
               <i class="fa-solid fa-trash"></i>
                    </a> @endcan`
                    },
                    name: 'id',
                }
            ]
        });

        $(document).on('click', '.delete-1', function(event) {
            var planId = $(event.currentTarget).attr('data-id');
            deleteItem(planUrl + '/' + planId, '#inAppPurchasePlanTbl', 'User');
        });

    </script>
@endsection
