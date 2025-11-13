@extends('dashboard')
@section('title')
    Roles
@endsection
@section('header')
    @can('role-create')
        <a href="{{ route('role.create') }}" class="btn btn-primary addModal"><i class="fa-solid fa-plus"></i>Add</a>
    @endcan
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body table-responsive">
                    <table class="table table-striped" id="roletable">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th width="100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('role-access')
                                @foreach ($roles as $role)
                                    <tr class="hover:bg-grey-lighter">
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permission as $value)
                                                <span class="badge badge-secondary">{{ $value->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('role-edit')
                                                <a href="{{ route('role.edit', ['id' => $role->id]) }}"
                                                    class="btn btn-sm edit-btn"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('role-delete')
                                                <a title="Delete" class="btn btn-sm delete-btn delete-role text-white"
                                                    data-id="{{ $role->id }}" href="{{ route('role.destroy', ['id' => $role->id]) }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        var table = $('#roletable').DataTable({
            order: [[0, 'asc']], // Ordering by the first column in descending order
            processing: true
        });

        // let planUrl = "{{ route('role') }}";
        // $(document).on('click', '.delete-role', function(event) {
        //     var planId = $(event.currentTarget).attr('data-id');
        //     deleteItem(planUrl + '/' + planId, '#inAppPurchasePlanTbl', 'Role');
        // });
        // location.reload();
    </script>
@endsection
