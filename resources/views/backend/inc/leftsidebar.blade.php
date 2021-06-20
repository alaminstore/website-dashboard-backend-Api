<div class="left side-menu">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/users/avatar-1.jpg')}}" height="40" alt="logo" class="rounded-circle border">
                 <span style="font-size: 15px;">Antopolis</span></a>
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="/" class="waves-effect"><i
                            class="dripicons-device-desktop"></i><span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-suitcase"></i><span>Portfolio <span
                                class="float-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('backend.portfolio_cat')}}"
                               href="{{route('backend.portfolio_cat')}}"><i class="fa fa-share"></i><span></span>Categories</a>
                        </li>
                        <li>
                            <a class="nav-link waves-effect {{url()->current() == url('/portfolio-items')}}"
                               href="{{url('/portfolio-items')}}"><i class="fa fa-share"></i><span></span>Portfolio Items</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.clients')}}"
                       href="{{route('backend.clients')}}"><i class="ion-person"></i><span>Clients</span></a>
                </li>

                <li>
                    <a class="nav-link waves-effect {{url()->current() == url('/services')}}"
                       href="{{url('/services')}}"><i class="ion-ios7-bookmarks"></i><span>Services</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == url('/tags')}}" href="{{url('/tags')}}"><i
                            class="fa fa-odnoklassniki"></i><span>Tags</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.catservices')}}"
                       href="{{route('backend.catservices')}}"><i class="mdi mdi-briefcase-check"></i><span>Category Services</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.infos')}}"
                       href="{{route('backend.infos')}}"><i class="fa fa-info-circle"></i><span>Infos</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.counts')}}"
                       href="{{route('backend.counts')}}"><i class="ion-ionic"></i><span>Count</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.faqs')}}"
                       href="{{route('backend.faqs')}}"><i class="fa fa-modx"></i><span>Faqs</span></a>
                </li>
                <li>
                    <a class="nav-link waves-effect {{url()->current() == route('backend.terms')}}"
                       href="{{route('backend.terms')}}"><i class="mdi mdi-air-conditioner"></i><span>Terms Policies</span></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
