@extends('redprintUnity::master')

@section('css')
    @parent
@stop

@section('body')

    <!-- BEGIN .app-wrap -->
    <div class="app-wrap">
        <!-- BEGIN .app-heading -->
        <header class="app-header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-8 col-8">
                        <a href="{{ 
                            route(
                                config('redprintUnity.dashboard_route', 'backend.dashboard')
                            )
                        }}" class="logo">
                            <img src="{{ asset(config('redprintUnity.logo')) }}" alt="Backend Dashboard">
                        </a><a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
                            <i class="icon-sort"></i>
                        </a>
                        <a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
                            <i class="icon-chevron-thin-left"></i>
                        </a>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 col-4">
                        <ul class="header-actions">
                            <li class="dropdown">
                                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                                    <i class="icon-notifications_none"></i>
                                    <span class="count-label"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="notifications">
                                    <ul class="imp-notify">
                                        @section('notifications')
                                            <li>
                                            {{ 
                                                trans(
                                                    'redprintUnity::core.no_new_notifications'
                                                )
                                            }}
                                            </li>
                                        @show
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- END: .app-heading -->
        <!-- BEGIN .app-container -->
        <div class="app-container">

            <!-- BEGIN .app-side -->
            <aside class="app-side" id="app-side">
                <!-- BEGIN .side-content -->
                <div class="side-content ">
                    <!-- BEGIN .user-profile -->
                    <div class="user-profile">
                        @section('current_user_avatar')
                            @if(config('redprintUnity.auth_user_avatar_field'))
                                <img src="{{ getUserAvatar() }}" class="profile-thumb" alt="User Thumb">
                            @else
                                <img src="{{ asset(config('redprintUnity.default_avatar')) }}" class="profile-thumb" alt="User Thumb">
                            @endif
                        @show
                        <h6 class="profile-name">@yield('current_user')</h6>
                        <ul class="profile-actions">
                            @section('profile-actions')
                            <!-- <li>
                                <a href="#">
                                    <i class="icon-social-skype"></i>
                                    <span class="count-label red"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li> -->
                            @show
                        </ul>
                        @section('profile-buttons')
                            <ul class="profile-buttons">
                                <li class="action-buttons">
                                    @if(config('redprintUnity.profile_route'))
                                    <a href="{{ route('backend.profile') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-user-circle font-white"></i>
                                            <span class="profile-buttons-text">
                                            {{ 
                                                trans(
                                                    'redprintUnity::core.profile'
                                                )
                                            }}
                                            </span>
                                    </a>
                                    @endif
                                    @if(config('redprintUnity.logout_route'))
                                    <a href="{{ route('backend.logout') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-power-off font-white"></i>
                                            <span class="profile-buttons-text">
                                            {{ 
                                                trans(
                                                    'redprintUnity::core.logout'
                                                )
                                            }}
                                            </span>
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        @show
                    </div>
                    <!-- END .user-profile -->
                    <!-- BEGIN .side-nav -->
                    <nav class="side-nav">
                        <!-- BEGIN: side-nav-content -->
                        <ul class="unifyMenu" id="unifyMenu">
                            @each('redprintUnity::partials.menu-item', $redprintUnity->menu(), 'item')
                        </ul>
                        <!-- END: side-nav-content -->
                    </nav>
                    <!-- END: .side-nav -->
                </div>
                <!-- END: .side-content -->
            </aside>
            <!-- END: .app-side -->


            <!-- BEGIN .app-main -->
            <div class="app-main">
                <!-- BEGIN .main-heading -->
                <header class="main-heading">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                <div class="page-icon">
                                    @section('page_icon')
                                        <i class="icon-laptop_windows"></i>
                                    @show
                                </div>
                                <div class="page-title">
                                    <h5>@yield('page_title')</h5>
                                    <h6 class="sub-heading">@yield('page_subtitle')</h6>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="right-actions">
                                    @yield('page_top_right_actions')
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

            @if(( isset($errors) && $errors->any()) || Session::has('error') || isset($error) || Session::has('message') || isset($message))

                    <div class="col-md-12">
                        <div id="messageBar" class="animated fadeInDown">
                            @if(isset($message) || Session::has('message'))
                                <div class="alert custom alert-info">
                                    <i class="icon-info-large"></i>
                                    {!! isset($message) ? $message : Session::get('message') !!}
                                </div>
                            @endif
                        </div>
                    </div>
            @endif
                <!-- END: .main-heading -->
                <!-- BEGIN .main-content -->
                <div class="main-content">
                    @yield('content')                   
                </div>
                <!-- END: .main-content -->
            </div>
            <!-- END: .app-main -->
        </div>
        <!-- END: .app-container -->
        <!-- BEGIN .main-footer -->
        <footer class="main-footer">
            @section('footer')
                {{ 
                    config(
                        'redprintUnity.powered_by', '&copy; Redprint by Intelle Hub Inc.'
                    )
                }}
            @stop
        </footer>
        <!-- END: .main-footer -->
    </div>
    <!-- END: .app-wrap -->

    @if(isset($success) || Session::has('success'))
        @section('post-js')
            @parent
            <script>
                $(document).ready(function() {
                    swal({
                        text: {!! json_encode(isset($success) ? $success : Session::get('success')) !!},
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @stop
    @endif

@stop
