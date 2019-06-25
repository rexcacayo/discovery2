@extends('redprintUnity::master')

@section('body')

    <body class="login-bg">
            
        <div class="container">
            <div class="login-screen row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <form action="{{ route('backend.register.post') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="login-container">
                            <div class="row no-gutters">
                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                    <div class="login-box">
                                        <a href="#" class="login-logo">
                                            <img src="{{ asset('vendor/redprintUnity/img/redprint_default.png') }}" alt="Backend" />
                                        </a>

                                        <div class="input-group">
                                            <span class="input-group-addon" id="first_name"><i class="icon-account_circle"></i></span>
                                            <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" aria-describedby="First Name" name="first_name">
                                        </div>
                                        <br />

                                        <div class="input-group">
                                            <span class="input-group-addon" id="last_name"><i class="icon-account_circle"></i></span>
                                            <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" aria-describedby="Last Name" name="last_name">
                                        </div>
                                        <br />

                                        <div class="input-group">
                                            <span class="input-group-addon" id="email"><i class="icon-account_circle"></i></span>
                                            <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email" name="email">
                                        </div>
                                        <br>

                                        <div class="input-group">
                                            <span class="input-group-addon" id="password"><i class="icon-verified_user"></i></span>
                                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password" name="password">
                                        </div>
                                        <br />

                                        <div class="input-group">
                                            <span class="input-group-addon" id="password_confirmation"><i class="icon-verified_user"></i></span>
                                            <input type="password" class="form-control" placeholder="Password Confirmation" aria-label="Password Confirmation" aria-describedby="password_confirmation" name="password_confirmation">
                                        </div>


                                        <div class="actions clearfix">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                      </div>
                                      <div class="mt-4">
                                        @section('login')
                                        @show
                                      </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                                    <div class="login-slider"></div>
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
                    Powered by Redprint
                @show
            </div>
        </footer>
    </body>

@stop
