@extends('dashboard')
@section('title')
    Purchage
@endsection
@section('extra_css')
    {{-- !important; --}}
    <style>
        /* Custom CSS for adding borders between every row in the table */
        #purchageTable tbody tr td {
            border-bottom: 1px solid #dee2e6 !important;
        }
        #purchageTable {
            table-layout: fixed; /* Fixed table layout to ensure consistent column widths */
        }
    </style>
@endsection

@section('content')
@can('purchage-access')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Date Filter</span>
                            <input class="form-control" type="text" name="daterange" value="" />
                        </div>
                        {{-- &nbsp;&nbsp;&nbsp; --}}
                        <div class="ml-4"></div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1">Status Filter</span>
                            <select name="statusFilter" style="width: 200px;">
                                <option value="">All</option>
                                <option value="1">success</option>
                                <option value="2">pending</option>
                                <option value="3">in-app success</option>
                                <!-- Add more options if needed -->
                            </select>
                            <div style="margin-right: 20px;"></div>
                            <button class="btn btn-success filter" style="width: 80px;" type="button">Filter</button>
                            <div style="margin-right: 20px;"></div>
                            <button class="btn btn-danger d-none" id="deleteAllBtn" type="button">Delete</button>
                        </div>
                    </div>
                </div>

                @include('purchage.table')
            </div>
        </div>
    </div>
    </div>
@endcan
@endsection
@section('scripts')
    <script>
        $('input[name="daterange"]').daterangepicker({
            startDate: moment().subtract(2, 'M'),
            endDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 15 Days': [moment().subtract(14, 'days'), moment()],
                'This Week': [moment().startOf('week'), moment().endOf('week')],
                'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf(
                    'week')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')],
                'Last 3 Months': [moment().subtract(3, 'months').startOf('month'), moment().subtract(1, 'months')
                    .endOf('month')
                ],
                'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().subtract(1, 'months')
                    .endOf('month')
                ],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf(
                    'year')]
            }
        });


        let userUrl = "{{ route('purchage') }}";
        var tableName = '#purchageTable';
        var tbl = $(tableName).DataTable({
            "destroy": true,
            "sScrollX": "100%",
            "sScrollXInner": "150%",
            "bScrollCollapse": true,
            order: [1, 'desc'],
            processing: true,
            serverSide: true,
            ajax: {
                url: userUrl,
                data: function(d) {
                    d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate.format(
                        'YYYY-MM-DD');
                    d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format(
                        'YYYY-MM-DD');
                    d.status = $('select[name="statusFilter"]').val();
                }
            },
            columns: [
                {
                    data: function data(row) {
                        var url = userUrl + '/' + row.id;
                        return `<input type="checkbox" name="user_checkbox" data-id="${row.id}"><label for=""></label>`
                    },
                    name: 'id',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable: true,
                    searchable: true,

                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Parse the date string to a Date object
                            var dateObj = new Date(data);

                            // Format the date and time as per the desired format
                            var formattedDate = dateObj.toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: '2-digit'
                            });
                            var formattedTime = dateObj.toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });

                            // Combine date and time with a space in between
                            var formattedDateTime = formattedDate + ' ' + formattedTime;

                            return formattedDateTime;
                        }
                        // For other types (sorting, type detection, etc.), return the original data
                        return data;
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                    return '₹ ' + data; // Add the Rupee symbol before the price
                }
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'plan_name',
                    name: 'plan_name'
                },
                {
                    data: 'payment_getway',
                    name: 'payment_getway'
                },
                // {
                //     data: 'app_name',
                //     name: 'app_name'
                // },
                // {
                //     data: 'transaction_key',
                //     name: 'transaction_key'
                // },
                {
                    data: function data(row) {
                        if (row.status == '1') {
                            var value = "Success";
                        }
                        if (row.status == '2') {
                            var value = "pending";
                        }
                        if (row.status == '3') {
                            var value = "in-app success";
                        }

                        return value;
                    },
                    name: 'status'
                }
                // {
                //     data: 'created_at',
                //     name: 'created_at'
                // },
                // {
                //     data: 'response',
                //     name: 'response'
                // }
            ],
            "lengthMenu": [10, 25, 50, 100, 500, 1000],


        }).on('draw', function() {
            $('input[name="user_checkbox"]').each(function() {
                this.checked = false;
            });
            $('input[name="main_checkbox"]').prop('checked', false);
            $('button#deleteAllBtn').addClass('d-none');
        });


        $(document).on('click', 'input[name="main_checkbox"]', function() {
            if (this.checked) {
                $('input[name="user_checkbox"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="user_checkbox"]').each(function() {
                    this.checked = false;
                });
            }
            toggledeleteAllBtn();
        });

        $(document).on('change', 'input[name="user_checkbox"]', function() {

            if ($('input[name="user_checkbox"]').length == $('input[name="user_checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            toggledeleteAllBtn();
        });

        function toggledeleteAllBtn() {
            if ($('input[name="user_checkbox"]:checked').length > 0) {
                $('button#deleteAllBtn').text('Delete (' + $('input[name="user_checkbox"]:checked').length + ')')
                    .removeClass('d-none');
            } else {
                $('button#deleteAllBtn').addClass('d-none');
            }
        }

        $(document).on('click', 'button#deleteAllBtn', function() {
            var checkedUsers = [];
            $('input[name="user_checkbox"]:checked').each(function() {
                checkedUsers.push($(this).data('id'));
            });

            $.ajax({
                url: '{{ route('deleteAll') }}',
                type: 'DELETE',
                data: {
                    id: checkedUsers
                },
                success: function(response) {

                    $('#userTbl').DataTable().ajax.reload(null, true);
                    console.log(response.message);
                    tbl.draw();
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        });

        $(".filter").click(function() {
            tbl.draw();
        });


        $(document).ready(function() {
            $.ajax({
                url: userUrl,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var totalSum = response.total_amount;
                    $('#sumElement').text(totalSum);
                }
            });
        });
    </script>
@endsection
