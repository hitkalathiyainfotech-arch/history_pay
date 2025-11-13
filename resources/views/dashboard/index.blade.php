@extends('dashboard')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <style>
        .time_range {
            border: 1px solid #dee2e6 !important;
            display: inline-block;
            padding: 0.5rem !important;
            border-radius: 0.313rem !important;
        }
    </style>
@can('dashboard')
    <div class="card">
        <div class="card-header">
            <h3>Leaderboard</h3>
        </div>


        <div class="card-body table-responsive">
            <table class="table table-bordered" id="leaderTbl">
                <thead>
                    <tr>
                        <th scope="col">{{ __('id') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Mining Point') }}</th>
                        <th scope="col">{{ __('Purchase Amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{--                @foreach ($data['users'] as $user) --}}
                    {{--                    <tr> --}}
                    {{--                        <td>{{$user->first_name}}{{$user->last_name}}</td> --}}
                    {{--                        <td>{{$user->email}}</td> --}}
                    {{--                        <td>{{$user->mining->mining_point}}</td> --}}
                    {{--                        <td>{{$user->payment?$user->payment->plan->price:'-'}}</td> --}}
                    {{--                    </tr> --}}
                    {{--                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endcan
@endsection
@section('scripts')
    <script type="text/javascript">
        let leaderUrl = "{{ route('dashboard') }}";
        let page = "{{ $page }}";
        var tableName = '#leaderTbl';
        var tbl = $(tableName).DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            pageLength: page,
            order: [[3, 'desc']],

            ajax: {
                url: leaderUrl
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },{
                    data: function data(row) {
                        if (row.first_name && row.last_name) {
                            return row.first_name + ' ' + row.last_name
                        } else {
                            return "-"
                        }
                    },
                    name: 'first_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: function data(row) {
                        return row.mining_point
                    },
                    name: 'mining_point'
                },
                {
                    data: function data(row) {
                        return row.payment ? row.payment.plan.price : '-'
                    },
                    name: 'email'
                },
            ]
        });
    </script>
@endsection
