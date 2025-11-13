{{-- Temporary        -------------------------------------------- --}}

@php
    $otps = DB::table('email_verifications')
        ->where('email', 'rohitjikadra@gmail.com')
        ->select('otp')
        ->get();
    $otp = $otps[0]->otp;
@endphp
<br><br><br><br><br>

<h5>{{ $otp }}</h5><br><br><br>
{{-- Temporary         -------------------------------------------- --}}

{{-- <div style="max-width: 1140px;">
    <div style="text-align: center!important; display: flex; flex-wrap: wrap; margin-right: -15px; margin-left: -15px;">
        <div style="width: 50%; border-radius: 20px; box-shadow: 0px 0px 20px #e96f6f; margin: 5em auto; display: flex; background-color: #fff; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
            <div style="box-sizing: border-box; display: flex; flex-wrap: wrap; margin-right: -15px; margin-left: -15px;"> --}}




    <p id="message_error" style="color:red;"></p>
    <p id="message_success" style="color:green;"></p>
    {{-- <form method="post" id="verificationForm"> --}}
        {{-- @csrf --}}
        <form>
        <input type="hidden" name="email" value="email">
        {{-- <input type="hidden" name="email" value="{{ $email }}"> --}}
        <input type="number" name="otp" placeholder="Enter OTP" required
            style="width: 100%;
                    border: 0px solid transparent;
                    border-radius: 30px;
                    border-bottom: 1px solid #bc1c1c;
                    padding: .5em .5em .5em;
                    padding-left: 10px;
                    padding-left: 2em;
                    outline: none;
                    margin: 1.5em auto;
                    transition: all .5s ease;">
        <br><br>
        <input type="submit" value="Verify"
            style="transition: all .5s ease;
                    width: 70%;
                    border-radius: 30px;
                    color: white;
                    font-weight: 600;
                    background-color: #bc1c1c;
                    border: 1px solid #bc1c1c;
                    margin-top: 1.5em;
                    margin-bottom: 1em;">

    </form>

    <p class="time"></p>

    <button id="resendOtpVerification">Resend Verification OTP</button>
{{-- </div></div></div></div> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

{{-- <script>
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
</script> --}}
