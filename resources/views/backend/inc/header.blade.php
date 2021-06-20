<div class="topbar">
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">

            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user" class="rounded-circle border">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" href="{{route('auth.settings')}}"><i class="mdi mdi-account-settings-variant"></i> Settings</a>
                    <a class="dropdown-item" href="{{route('auth.logout')}}"><i class="dripicons-exit text-muted"></i> Logout</a>
                </div>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                </div>
            </li>
        </ul>
        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">@yield('title','Antopolis-Dashboard')</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
