<ul class="navbar-nav">
    <li class="nav-item">
        <!-- <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a> -->

    </li>
</ul>



<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" style="text-align: right; padding-right: 22px; color: grey; font-weight: bold;">
            {{auth()->user()->name}}
       <a href=""> <img src="{{asset('public/upload/facelook.jpg')}}" height="60px" width="200px;" style="margin-top: -46px;"></a>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{route('profile-management.change.password')}}" class="dropdown-item" >
                <i class="fas fa-lock"></i> Change Password
            </a>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-lock"></i> Logout
            </a>
            <form style="display: none;" method="post" id="logout-form" action="{{route('logout')}}">
                @csrf
            </form>
        </div>        
    </li>
</ul>