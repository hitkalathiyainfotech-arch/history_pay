@extends('dashboard')
@section('title')
    Users
@endsection
@section('extra_css')
    {{-- !important; --}}
    <style>
        /* Custom CSS for adding borders between every row in the table */
        #userTbl tbody tr td {
            border-bottom: 1px solid #dee2e6 !important;
        }
        #userTbl {
            table-layout: fixed; /* Fixed table layout to ensure consistent column widths */
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="userTbl">
                        <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" name="main_checkbox"><label for=""></label></th>
                            <th scope="col">{{ __('#') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Contact') }}</th>
                            <th scope="col">{{ __('Date & Time') }}</th>
                            <th scope="col">{{ __('Contact Access ') }}<button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete</button></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let userUrl = "{{ route('users') }}";
        let page = "{{ $page }}";
        var tableName = '#userTbl';
        var tbl = $(tableName).DataTable({
            processing: true,
            serverSide: true,
            pageLength: page,
            searchDelay: 500,
            order: [
                [1, 'desc']
            ],
            ajax: {
                url: userUrl,
                data: function(d) {
                    d.date = $('#date').val()
                }
            },
            columns: [
                {
                    data: function data(row) {
                        var url = userUrl + '/' + row.id;
                        return `<input type="checkbox" name="user_checkbox" data-id="${row.id}"><label for=""></label>`
                    },
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            var dateObj = new Date(data);
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
                            var formattedDateTime = formattedDate + ' ' + formattedTime;

                            return formattedDateTime;
                        }
                        return data;
                    }
                },
                // {
                //     data: function data(row) {
                //         return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('DD/MM/YY hh:mm:ss');
                //     },
                //     name: 'created_at'
                // },
                {
                    data: function data(row) {
                        var url = userUrl + '/' + row.id;
                        return `
                   <a title="Edit" class="btn btn-sm edit-btn" data-id="${row.id}" href="${url}/show">
            <i class="fa fa-edit"></i>
                </a> <a title="Delete" class="btn btn-sm delete-btn text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a>`
                    },
                    name: 'id',
                    orderable: false,
                    searchable: false
                }
            ]

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
                url: '{{ route('delete.selected.users') }}',
                type: 'DELETE',
                data: {
                    id: checkedUsers
                },
                success: function(response) {
                    $('#userTbl').DataTable().ajax.reload(null, true);
                    console.log(response.message);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
        $(document).on('click', '.delete-btn', function(event) {
            var userId = $(event.currentTarget).attr('data-id');
            deleteItem(userUrl + '/' + userId, tableName, 'User');
        });
    </script>
@endsection
