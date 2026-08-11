<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
     <div class="navbar-brand-box">
        <a href="{{url('index')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/rubik.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/zysd.png') }}" alt="" height="40">
            </span>
        </a>

        <a href="{{url('index')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/rubik.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/zys.png') }}" alt="" height="40">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{url('index')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>



                <li class="menu-title">@lang('translation.Apps')</li>

                <li>
                    <a href="calendar" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>@lang('translation.Calendar')</span>
                    </a>
                </li>

                <li>
                    <a href="chat" class=" waves-effect">
                        <i class="uil-comments-alt"></i>
                        <span>@lang('translation.Chat')</span>
                    </a>
                </li>




                <li class="menu-title">@lang('translation.Pages')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-circle"></i>
                        <span>@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-lock-screen">@lang('translation.Lock_Screen')</a></li>
                    </ul>
                </li>



                <li class="menu-title">@lang('translation.Components')</li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-list-ul"></i>
                        <span>@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic">@lang('translation.Bootstrap_Basic')</a></li>
                        <li><a href="tables-datatable">@lang('translation.Datatables')</a></li>
                        <li><a href="tables-responsive">@lang('translation.Responsive')</a></li>
                        <li><a href="tables-editable">@lang('translation.Editable')</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
