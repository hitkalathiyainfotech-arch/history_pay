<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Capture</title>

    {{-- <!-- <title>@yield('title')@yield('title1')</title> --> --}}





    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('payment.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.print.css') }}"
        media="print">
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cdn/buttons.dataTables.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/dist/adminlte.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/flat/blue.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="styles heet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('assets/css/fonts/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pnotify.custom.min.css') }}" media="all" rel="stylesheet"
        type="text/css" />
    <!--sweetalert2  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('assets/izitoast/css/iziToast.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('new-script')
    <style>
        .nav-logo {
            width: 30%;
            margin: 0px auto;
            padding-top: 5px;
            display: block;
        }

        .nav-logo-width {
            width: 70%;
            padding-top: 20px;
        }

        .card-head-div {
            display: flex;
            justify-content: end;
        }

        /*.main-header{*/
        /*position: fixed;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    width: calc(100% - 260px);*/
        /*}*/
        input[type='file'] {
            display: none;
        }

        .file-label {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        /*.content-wrapper .header-div{*/
        /*    top: 57px;*/
        /*    position: fixed;*/
        /*    z-index: 1;*/
        /*}*/
        /*.content-wrapper>.content {*/
        /*    padding: 120px 0rem 0;*/
        /*}*/
        .campus-sidebar {
            height: 100vh;
        }

        .footer {
            bottom: 0;
            position: sticky;
            width: 100%;
        }

        .alert {
            background: #23b1f5 !important;
            border-color: #23b1f5 !important;
            font-weight: bold;
        }

        .mandatory {
            color: #ff0000;
            font-weight: bold;
        }

        .btn-default {
            background-color: #23b1f5;
            color: #fff;
        }

        .btn-default.hover,
        .btn-default:active,
        .btn-default:hover {
            background-color: #23b1f5;
            color: #fff;
        }
    </style>
    @yield('extra_css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.header')
        <!-- /.navbar -->

        <aside class="main-sidebar">
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <div class="bg-white py-2 d-sm-flex justify-content-between">
                {{-- <div class="container-fluid bg-white pt-3 header-div d-flex justify-content-between"> --}}
                    <div>
                        @yield('heading')
                        <h3 class="card-title m-0 pl-4" style="padding-top: 5px;">@yield('title')</h3>
                    </div>
                    <div class="mr-2">
                        @yield('header')
                    </div>
                {{-- </div> --}}
            </div>
            <section class="content mt-4">
                <div class="container-fluid px-5">
                    @include('flash::message')
                    @yield('content')
                </div>
                {{--            <div class="footer bg-white p-3"> --}}
                {{--                <div class="text-dark"> --}}
                {{--                    <span class="">All Rights Reserved ©2022</span> --}}
                {{--                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Smart Campus</a> --}}
                {{--                </div> --}}
                {{--            </div> --}}
            </section>
        </div>
        {{-- <aside class="control-sidebar control-sidebar-dark">

        </aside> --}}
        <div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="changePassword" autocomplete="off">
                            <div class="form-group col-sm-12">
                                @csrf
                                <label class="col-form-label">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    placeholder="Old Password">
                                <label class="col-form-label">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="New Password">
                                <label class="col-form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" placeholder="Confirm Password">
                                <span style="color:red;" id="CheckPasswordMatch"></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updatePassword">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('script2')

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
    <script>
        let loaderUrl = "{{ asset('public/loader.gif') }}";
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/cdn/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/cdn/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/cdn/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/izitoast/js/iziToast.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.alert').delay(3000).slideUp(300);
            $('.toggle-nav').click(function() {
                var navClass = $(".nav-logo").hasClass("nav-logo-width");
                if (navClass) {
                    $(".nav-logo").removeClass("nav-logo-width");
                } else {
                    $(".nav-logo").addClass("nav-logo-width");
                }
            })
        });
        $('#change_password').on('click', function() {
            $('#change').modal('show');
            $('#changePassword').trigger("reset");
            $("#CheckPasswordMatch").html("");
        });
        $('#confirm_password,#new_password').on('input', function(e) {
            if ($("#new_password").val() != $("#confirm_password").val()) {
                $("#CheckPasswordMatch").html("Passwords does not match!");
            } else {
                $("#CheckPasswordMatch").html("");
            }
        });
        $('#updatePassword').click(function(event) {
            event.preventDefault()
            var myform = document.getElementById("changePassword");
            var formData = new FormData(myform);

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: "POST",
                url: "{{ route('changePassword') }}",
                data: formData,
                success: function(data) {
                    if (data.status == 1) {
                        $('#change').modal('hide');
                        swal({
                            title: "Done!",
                            text: data.messages,
                            type: "success"
                        });
                        $('#changePassword').trigger("reset");
                    } else {
                        swal("ERROR!", data.messages, "error");
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
    @yield('scripts')
    {{-- <script src="{{asset('public/vendor/datatables/buttons.server-side.js')}}"></script> --}}
</body>

</html>
