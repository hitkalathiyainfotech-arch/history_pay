 <nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background-color: #000;"> {{-- position: fixed;width: 100%; --}}
    <!-- Left navbar links -->
    <ul class="navbar-nav toggle-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
     <ul class="navbar-nav ml-auto">  {{--  style="overflow: hidden;position: fixed;right: 0.5rem;" --}}
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                @if(Request::Cookie('appName'))
                <a class="btn btn-primary" href="{{route('apps.index')}}" role="button">
                    <i class="fa fa-arrow-left mr-1"></i>{{Request::Cookie('appName')}}
                </a>
                @else
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @if(Auth::user())
                        {{Auth::user()->first_name}}
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <div class="my-2">
                        <a id="change_password" href="#" class="m-3">Change Password</a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="m-3" href="{{route('logout')}}"
                                         onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
                @endif

            </li>
        </ul>
    </ul>
</nav>
