@extends('dashboard')
@section('title')Show User
@endsection
@section('header')<a href="{{ route('users') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{ __('Back') }}</a>@endsection
@section('extra_css')
    {{-- !important; --}}
    <style>
        /* Custom CSS for adding borders between every row in the table */
        #userConTbl tbody tr td {
            border-bottom: 1px solid #dee2e6 !important;
        }

        #userConTbl {
            table-layout: fixed;
            /* Fixed table layout to ensure consistent column widths */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: transparent !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="userConTbl">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 20px;"><input type="checkbox" name="main_checkbox"><label for=""></label></th>
                                <th scope="col"style="width: 90px;">{{ __('#') }}</th>
                                <th scope="col"style="width: 250px;">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Mobile') }}</th>
                                <th scope="col">{{ __('Action  ') }}<button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete</button></th>
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
        let userUrl = "{{ route('users.show', ['id' => $id]) }}";
        let page = "{{ $page }}";
        let deleteUrl = "{{ route('users') }}";
        var tableName = '#userConTbl';
        var tbl = $(tableName).DataTable({
            processing: true,
            serverSide: true,
            pageLength: page,
            searchDelay: 500,
            order: [
                [1, 'desc']
            ],
            ajax: {
                url: userUrl
            },
            columns: [
                {
                    data: function data(row) {
                        var url = userUrl + '/' + row.id;
                        return `<input type="checkbox" name="contact_checkbox" data-id="${row.id}"><label for=""></label>`
                    },
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: function data(row) {
                        return `<a title="Delete" class="btn btn-sm delete-btn text-white" data-id="${row.id}" href="#">
           <i class="fa-solid fa-trash"></i>
                </a>`
                    },
                    name: 'id',
                    orderable: false,
                    searchable: false
                }
            ]

        }).on('draw', function() {
            $('input[name="contact_checkbox"]').each(function() {
                this.checked = false;
            });
            $('input[name="main_checkbox"]').prop('checked', false);
            $('button#deleteAllBtn').addClass('d-none');
        });


        $(document).on('click', 'input[name="main_checkbox"]', function() {
            if (this.checked) {
                $('input[name="contact_checkbox"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="contact_checkbox"]').each(function() {
                    this.checked = false;
                });
            }
            toggledeleteAllBtn();
        });

        $(document).on('change', 'input[name="contact_checkbox"]', function() {

            if ($('input[name="contact_checkbox"]').length == $('input[name="contact_checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            toggledeleteAllBtn();
        });

        function toggledeleteAllBtn() {
            if ($('input[name="contact_checkbox"]:checked').length > 0) {
                $('button#deleteAllBtn').text('Delete (' + $('input[name="contact_checkbox"]:checked').length + ')')
                    .removeClass('d-none');
            } else {
                $('button#deleteAllBtn').addClass('d-none');
            }
        }

        $(document).on('click', 'button#deleteAllBtn', function() {
            var checkedContacts = [];
            $('input[name="contact_checkbox"]:checked').each(function() {
                checkedContacts.push($(this).data('id'));
            });

               alert(checkedContacts);
            $.ajax({
                url: '{{ route('delete.allselected.contacts') }}',
                type: 'DELETE',
                data: {
                    id: checkedContacts
                },
                success: function(response) {
                    $('#userConTbl').DataTable().ajax.reload(null, true);
                    console.log(response.message);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-btn', function(event) {
            var userId = $(event.currentTarget).attr('data-id');
            deleteItem(deleteUrl + '/contact/' + userId, tableName, 'User');
        });
    </script>
@endsection
