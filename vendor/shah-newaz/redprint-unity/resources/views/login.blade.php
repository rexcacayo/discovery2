@extends('redprintUnity::master')

@section('body')

    <body class="login-bg">
            
        <div class="container">
            <div class="login-screen row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <form action="{{ 
                        route(
                            config(
                                'redprintUnity.login_post_route',
                                'backend.login.post'
                            )
                        ) }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="login-container">
                            <div class="row no-gutters">
                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                    <div class="login-box">
                                        <a href="#" class="login-logo">
                                            <img src="{{ 
                                                asset(
                                                    config('redprintUnity.logo')
                                                )
                                            }}" alt="Backend" />
                                        </a>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="email"><i class="icon-account_circle"></i></span>
                                            <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email" name="email">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="password"><i class="icon-verified_user"></i></span>
                                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password" name="password">
                                        </div>
                                        <div class="actions clearfix">
                                        @section('lost_password')
                                        @show
                                        <button type="submit" class="btn btn-primary">{{ trans('redprintUnity::core.login') }}</button>
                                      </div>
                                      <div class="mt-4">
                                        @section('signup')
                                        @show
                                      </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                                    <div class="login-slider" style="background: url({{ 
                                        asset(config('redprintUnity.login_bg'))
                                    }})"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="main-footer no-bdr fixed-btm">
            <div class="container">
                @section('footer')
                    {!! 
                        config(
                            'redprintUnity.powered_by', '&copy; Redprint by Intelle Hub Inc.'
                        )
                    !!}
                @show
            </div>
        </footer>
    </body>

@stop
