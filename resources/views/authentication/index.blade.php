@extends('dashboard')

@section('title')
    Authentication
@endsection

@section('content')
@can('authentication')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger pb-0 pt-0">
                    <ul class="j-error-padding list-unstyled p-2 mb-0">
                        <li>{{ $errors->first() }}</li>
                    </ul>
                </div>
            @endif

            {{-- @php
                dd($user->email_verification);
            @endphp --}}

            {{ Form::model(['route' => ['authe.store'], 'files' => 'true']) }}
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xl-12 col-md-12 col-sm-12">

                            <span>
                                <h5><b>Setting </b></h5>
                            </span><br>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ isset($user) && $user->email_verification == '1' ? 'checked' : '' }}
                                    name="email_verification" id="email_verification">
                                {{ Form::label(__('Email OTP Verification')) }}
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card card-default">
                <div class="card-body">
                    <span>
                        <h5><b>Login Details </b></h5>
                    </span>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="userTbl_list">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col"><input type="checkbox" name="main_checkbox"><label
                                                    for=""></label></th> --}}
                                            <th scope="col">{{ __('id') }}</th>
                                            <th scope="col"style="width: 30rem;">{{ __('Device Name') }}</th>
                                            <th scope="col">{{ __('Ip Address') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('Plateform') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($device as $value)
                                            <tr>
                                                <td>{{ $value->device_name }}</td>
                                                <td>{{ $value->ip_address }}</td>
                                                <td>{{ $value->browser }}</td>
                                                <td>{{ $value->plateform }}</td>
                                                <td><a class="btn btn-sm delete-btn text-white" data-id="">
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></td>
                                            </tr>
                                        @endforeach --}}
                                        @foreach ($sessions as $session)
                                            <tr>
                                                <td>{{ $session->id }}</td>
                                                <td>{{ $session->user_agent }}</td>
                                                <td>{{ $session->ip_address }}</td>
                                                <td>{{ $session->email }}</td>
                                                {{-- <td>{{ $session->created_at }}</td> --}}
                                                <td>
                                                    <?php
                                                    $utcTime = new DateTime($session->created_at, new DateTimeZone('UTC'));
                                                    $indiaTimeZone = new DateTimeZone('Asia/Kolkata');
                                                    $indiaTime = $utcTime->setTimezone($indiaTimeZone);
                                                    echo $indiaTime->format('Y-m-d H:i:s');
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm delete-btn text-white logout-btn"
                                                        data-session-id="{{ $session->session_id }}"><i
                                                            class="fa-solid fa-arrow-right-from-bracket"></i>
                                                        Logout</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-body">

                    <span>
                        <h5><b>Logout All Devices</b></h5>
                    </span><br>

                    <form action="{{ url('logout_all') }}" method="POST">
                        @csrf
                        <div>
                            {{-- <label for="password">Password:</label> --}}
                            {{-- <input type="password" class="form-control" name="password" id="password" required><br> --}}
                        </div>
                        <button type="submit" class="btn btn-sm delete-btn text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout All Devices</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection



@section('scripts')
<script>
    var table = $('#userTbl_list').DataTable({

        order: [[0, 'desc']] // Ordering by the first column in descending order
    });
</script>
    <script>
        // Example AJAX request to logout a specific session
        const logoutButtons = document.querySelectorAll('.logout-btn');
        logoutButtons.forEach(button => {
            button.addEventListener('click', () => {
                const sessionId = button.getAttribute('data-session-id');
                const url = `/mining-app/logout-session/${sessionId}`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response as needed
                        console.log(data);

                        setTimeout(() => {
                            location.reload();
                        }, 300); // 1000 milliseconds = 1 second
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                    });
            });
        });
    </script>
@endsection
