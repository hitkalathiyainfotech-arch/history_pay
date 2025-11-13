@extends('dashboard')
@section('title')
    Plans
@endsection
@section('header')
    @can('plan-create')
        <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
                <a href="{{ route('plans.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a>
        </div>
    @endcan
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <h3>In App Purchase Plans</h3>
                    <div class="table-responsive tab-pane" id="inAppPurchase" role="tabpanel">
                        <table class="table table-bordered" id="inAppPurchasePlanTbl">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Plan ID') }}</th>
                                    <th scope="col">{{ __('Plan Name') }}</th>
                                    <th scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Speed') }}</th>
                                    <th scope="col">{{ __('Contract') }}</th>
                                    <th scope="col">{{ __('Minimum Withdraw') }}</th>
                                    <th scope="col">{{ __('Availability') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h3>Gateway Plans</h3>
                    <div class="table-responsive tab-pane" id="gateway" role="tabpanel">
                        <table class="table table-bordered" id="gatewayPlanTbl">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Plan ID') }}</th>
                                    <th scope="col">{{ __('Plan Name') }}</th>
                                    <th scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Speed') }}</th>
                                    <th scope="col">{{ __('Contract') }}</th>
                                    <th scope="col">{{ __('Minimum Withdraw') }}</th>
                                    <th scope="col">{{ __('Availability') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h3>Free Plans</h3>
                    <div class="table-responsive tab-pane" id="freeplan" role="tabpanel">
                        <table class="table table-bordered" id="freePlanTbl">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Plan ID') }}</th>
                                    <th scope="col">{{ __('Plan Name') }}</th>
                                    <th scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Speed') }}</th>
                                    <th scope="col">{{ __('Contract') }}</th>
                                    <th scope="col">{{ __('Minimum Withdraw') }}</th>
                                    <th scope="col">{{ __('Availability') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
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
        let planUrl = "{{ route('plans') }}";
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
            // columnDefs: [
            //     {
            //         'targets': [2],
            //         'orderable': false,
            //         'width': '8%'
            //     },
            // ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'plan_name',
                    name: 'plan_name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'speed',
                    name: 'speed'
                },
                {
                    data: 'contract',
                    name: 'contract'
                },
                {
                    data: 'minimum_withdraw',
                    name: 'minimum_withdraw'
                },
                {
                    data: 'availability',
                    name: 'availability'
                },
                {
                    data: function data(row) {
                        var active = row.active;
                        if(active == 1){
                            return `<a title="active" class="btn btn-sm btn-success" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Active</a>`
                        }
                        else{
                            return `<a title="active" class="btn btn-sm btn-danger" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Inctive</a>`
                        }

                        },
                    name: 'active'
                },
                {
                    data: function data(row) {
                        var url = planUrl + '/' + row.id;
                        return `@can('plan-edit')<a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>@endcan @can('plan-delete') <a title="Delete" class="btn btn-sm delete-btn delete-1 text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a> @endcan`
                    },
                    name: 'id',
                }
            ]
        });

        $(document).on('click', '.delete-1', function(event) {
            var planId = $(event.currentTarget).attr('data-id');
            deleteItem(planUrl + '/' + planId, '#inAppPurchasePlanTbl', 'Plan');
        });

        $(document).on('click', '.delete-2', function(event) {
            var planId = $(event.currentTarget).attr('data-id');
            deleteItem(planUrl + '/' + planId, '#gatewayPlanTbl', 'Plan');
        });

        var tbl1 = $('#gatewayPlanTbl').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: planUrl,
                data: {
                    'category': '2'
                }
            },
            // columnDefs: [
            //     {
            //         'targets': [2],
            //         'orderable': false,
            //         'width': '8%'
            //     },
            // ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'plan_name',
                    name: 'plan_name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'speed',
                    name: 'speed'
                },
                {
                    data: 'contract',
                    name: 'contract'
                },
                {
                    data: 'minimum_withdraw',
                    name: 'minimum_withdraw'
                },
                {
                    data: 'availability',
                    name: 'availability'
                },
                {
                    data: function data(row) {
                        var active = row.active;
                        if(active == 1){
                            return `<a title="active" class="btn btn-sm btn-success" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Active</a>`
                        }
                        else{
                            return `<a title="active" class="btn btn-sm btn-danger" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Inctive</a>`
                        }
                        },
                    name: 'active'
                },
                {
                    data: function data(row) {
                        var url = planUrl + '/' + row.id;
                        return `@can('plan-edit') <a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a>@endcan  @can('plan-delete') <a title="Delete" class="btn btn-sm delete-btn delete-2 text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a> @endcan`
                    },
                    name: 'id',
                }
            ]
        });
        var tbl2 = $('#freePlanTbl').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: planUrl,
                data: {
                    'category': '0'
                }
            },
            // columnDefs: [
            //     {
            //         'targets': [2],
            //         'orderable': false,
            //         'width': '8%'
            //     },
            // ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'plan_name',
                    name: 'plan_name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'speed',
                    name: 'speed'
                },
                {
                    data: 'contract',
                    name: 'contract'
                },
                {
                    data: 'minimum_withdraw',
                    name: 'minimum_withdraw'
                },
                {
                    data: 'availability',
                    name: 'availability'
                },
                {
                    data: function data(row) {
                        var active = row.active;
                        if(active == 1){
                            return `<a title="active" class="btn btn-sm btn-success" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Active</a>`
                        }
                        else{
                            return `<a title="active" class="btn btn-sm btn-danger" data-id="${row.id}" href="{{ url('change_status/${row.id}') }}">Inctive</a>`
                        }
                        },
                    name: 'active'
                },
                {
                    data: function data(row) {
                        var url = planUrl + '/' + row.id;
                        return `@can('plan-edit') <a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/edit">
            <i class="fa fa-edit"></i>
                </a> @endcan  @can('plan-delete')<a title="Delete" class="btn btn-sm delete-btn delete-2 text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a> @endcan`
                    },
                    name: 'id',
                }
            ]
        });
    </script>
@endsection
