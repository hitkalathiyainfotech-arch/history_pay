@extends('dashboard')
@section('title')
    Withdrawal
@endsection
@section('header')
    <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
        <div>
            {{ Form::text('datepicker', null, ['class' => 'form-control','id'=>'datepicker']) }}
            {{ Form::hidden('date', null, ['class' => 'form-control','id'=>'date']) }}
        </div>
       {{-- <a href="{{route('plans.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a> --}}
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('withdrawal.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply:true
        });
        let withdrawalUrl = "{{route('withdrawal')}}";
        var tableName = '#withdrawalTbl';
    var tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
         order: [[7, 'desc']],
        ajax: {
            url: withdrawalUrl,
            data: function (d) {
                d.date = $('#date').val()
            }
        },
        // columnDefs: [
        //     {
        //         'targets': [2],
        //         'orderable': false,
        //         'width': '8%'
        //     },
        // ],
        columns: [
            {
                    data: function data(row) {
                        var url = withdrawalUrl + '/' + row.id;
                        // console.log(row.id);
                        return `<input type="checkbox" name="withdraw_checkbox" data-id="${row.id}"><label for=""></label>`
                    },
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
            {
                data: function data(row){
                    return row.user.first_name +' '+ row.user.last_name
                },
                name: 'id'
            },
            {
                data: function data(row){
                       return row.user.email
                },
                name: 'id'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'time',
                name: 'time'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'coin_name',
                name: 'coin_name'
            },
            {
                data: function data(row) {
                    return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
                },
                name: 'created_at'
            }]
    }).on('draw', function() {
            $('input[name="withdraw_checkbox"]').each(function() {
                this.checked = false;
            });
            $('input[name="main_checkbox"]').prop('checked', false);
            $('button#deleteAllBtn').addClass('d-none');
        });


        $(document).on('click', 'input[name="main_checkbox"]', function() {
            if (this.checked) {
                $('input[name="withdraw_checkbox"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="withdraw_checkbox"]').each(function() {
                    this.checked = false;
                });
            }
            toggledeleteAllBtn();
        });


        $(document).on('change', 'input[name="withdraw_checkbox"]', function() {

        if ($('input[name="withdraw_checkbox"]').length == $('input[name="withdraw_checkbox"]:checked').length) {
            $('input[name="main_checkbox"]').prop('checked', true);
        } else {
            $('input[name="main_checkbox"]').prop('checked', false);
        }
        toggledeleteAllBtn();
        });


        function toggledeleteAllBtn() {
            if ($('input[name="withdraw_checkbox"]:checked').length > 0) {
                $('button#deleteAllBtn').text('Delete (' + $('input[name="withdraw_checkbox"]:checked').length + ')')
                    .removeClass('d-none');
            } else {
                $('button#deleteAllBtn').addClass('d-none');
            }
        }


        $(document).on('click', 'button#deleteAllBtn', function() {
            var checkedWithdraws = [];
            $('input[name="withdraw_checkbox"]:checked').each(function() {
                checkedWithdraws.push($(this).data('id'));
            });

               alert(checkedWithdraws);
            $.ajax({
                url: '{{ route('withdrawal.selected.users') }}',
                type: 'DELETE',
                data: {
                    id: checkedWithdraws
                },
                success: function(response) {
                    // Handle the success response
                    $('#userTbl').DataTable().ajax.reload(null, true);
                    console.log(response.message);
                    // Refresh the page or update the UI as needed
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        });










        $("#datepicker").change(function () {
            $('#date').val($("#datepicker").val());
            $(tableName).DataTable().draw(true);
        });

    $(document).on('click', '.delete-btn', function (event) {
        var userId = $(event.currentTarget).attr('data-id');
        deleteItem(userUrl + '/' + userId, tableName, 'User');
    });
    </script>
@endsection
