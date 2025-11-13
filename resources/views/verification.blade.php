<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Document</title>
    <style>
        body {
            display: table;
            width: 98vw;
            height: 100vh;
            overflow-x: auto;
        }

        .cell-cell-cell {
            display: table-cell;
            vertical-align: middle
        }

        .main-content {
            width: 50%;
            border-radius: 20px;
            box-shadow: 0px 0px 20px #e96f6f;
            margin: 5em auto;
            display: flex;
        }

        /* .company__info {
            background-color: whitesmoke;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        } */

        /* .fa-dollar-sign {
            font-size: 3em;
        } */

        #remember_me {
            margin-top: 6px;
            margin-right: 8px;
            font-weight: 600;
        }

        .login_form {
            background-color: #fff;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            /*border-top: 1px solid #D94B09;*/
            /*border-right: 1px solid #D94B09;*/
        }

        form {
            padding: 0 2em;
        }

        .form__input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 30px;
            border-bottom: 1px solid #bc1c1c;
            padding: .5em .5em .5em;
            padding-left: 10px;
            padding-left: 2em;
            outline: none;
            margin: 1.5em auto;
            transition: all .5s ease;
        }

        /* .form__input:focus {
            border-bottom-color: #bc1c1c;
            box-shadow: 0 0 5px rgba(30 64 128 / 41%);
            border-radius: 4px;
        } */

        .signin-btn {
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            background-color: #bc1c1c;
            border: 1px solid #bc1c1c;
            margin-top: 1.5em;
            margin-bottom: 1em;
        }

        .signin-btn:hover,
        .signin-btn:focus {
            background-color: #e8f0fe;
            border-bottom: 1px solid #bc1c1c;
            color: #bc1c1c;
            /* border: 2px solid #1E4080; */
        }

        .click {
            color: #F97B40;
        }
    </style>

</head>

<body>


    {{-- Temporary        -------------------------------------------- --}}
    {{-- @php
        $otps = DB::table('email_verifications')
            ->where('email', 'rohit.mivaninfotech@gmail.com')
            ->select('otp')
            ->get();
        $otp = $otps[0]->otp;
    @endphp --}}

    {{-- Temporary         -------------------------            ------------------- --}}





    {{-- <form method="post" id="verificationForm">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="number" name="otp" placeholder="Enter OTP" required>
        <br><br>
        <input type="submit" value="Verify">

    </form> --}}
    <div class="cell-cell-cell">
        <div class="container">
            <div class="row text-center">
                <div class="main-content login_form">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="pt-4">OTP Verification</h2>
                            {{-- {{ $otp }} --}}
                        </div>
                        <p id="message_error" style="color:red;margin: auto;"></p>
                        <p id="message_success" style="color:green;margin: auto;"></p>
                        <div class="col-12">
                            <form id="verificationForm" method="POST">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="text" name="otp" class="form__input" placeholder="Enter OTP"
                                    maxlength="6" required>

                                <p class="time"></p>

                                <div class="row">
                                    <input type="submit" value="Verify" class="btn signin-btn mx-auto">
                                </div>

                                {{-- <a id="resendOtpVerification">Resend Verification OTP</a> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <p class="time"></p> --}}

    {{-- <button id="resendOtpVerification">Resend Verification OTP</button> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#verificationForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('verifiedOtp') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            var home_url = "{{ url('apps') }}";
                            window.open(home_url, "_self");
                        } else {
                            $('#message_error').text(res.msg);
                            setTimeout(() => {
                                $('#message_error').text('');
                            }, 3000);
                        }
                    }
                });

            });

            $('#resendOtpVerification').click(function() {
                $(this).text('Wait...');
                var userMail = @json($email);

                $.ajax({
                    url: "{{ route('resendOtp') }}",
                    type: "GET",
                    data: {
                        email: userMail
                    },
                    success: function(res) {
                        $('#resendOtpVerification').text('Resend Verification OTP');
                        if (res.success) {
                            timer();
                            $('#message_success').text(res.msg);
                            setTimeout(() => {
                                $('#message_success').text('');
                            }, 3000);
                        } else {
                            $('#message_error').text(res.msg);
                            setTimeout(() => {
                                $('#message_error').text('');
                            }, 3000);
                        }
                    }
                });

            });
        });

        function timer() {
            var seconds = 30;
            var minutes = 1;

            var timer = setInterval(() => {

                if (minutes < 0) {
                    $('.time').text('');
                    clearInterval(timer);
                } else {
                    let tempMinutes = minutes.toString().length > 1 ? minutes : '0' + minutes;
                    let tempSeconds = seconds.toString().length > 1 ? seconds : '0' + seconds;

                    $('.time').text(tempMinutes + ':' + tempSeconds);
                }

                if (seconds <= 0) {
                    minutes--;
                    seconds = 59;
                }

                seconds--;

            }, 1000);
        }

        timer();
    </script>




</body>

</html>
