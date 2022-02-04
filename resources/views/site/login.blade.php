@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')

<section class="breadcrumb">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumb-title-div">
                <div class="bread-left-side">
                    <h2>Login</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--//breadcrumb-->
<!--Services-->
<section class="main">
    <section class="digital-services-body">
        <div class="row">
            <!--start form content-->
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="form-cont">
                    <h3>Login</h3>
                    <form id="login-form" class="main-form" action="{{ Route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter Your Email*"  name="email" value="<?php
                            if (isset($_COOKIE['user_email']) && $_COOKIE['user_email'] !== NULL) {
                                echo $_COOKIE['user_email'];
                            }
                            ?>">
                            <div class="help-block" id="err-email"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Enter Your Password*" name="password" value="<?php
                            if (isset($_COOKIE['user_password']) && $_COOKIE['user_password'] !== NULL) {
                                echo $_COOKIE['user_password'];
                            }
                            ?>">
                            <div class="help-block" id="err-password"></div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="remember" name="remember" value="1" <?php
                                   if (isset($_COOKIE['user_email']) && $_COOKIE['user_password'] !== NULL) {
                                       echo 'checked="checked"';
                                   }
                                   ?>>
                            <label for="vehicle1">Remember Me</label>
                        </div>
                        <button type="submit">LOGIN</button>
                    </form>
                </div>
            </div>
            <!--end form content-->
        </div>	
    </section>
</section>


@stop
@section('js')


@endsection