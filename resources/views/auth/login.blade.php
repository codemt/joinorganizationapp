@extends('layouts.app')

@section('content')
    @if( Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ Session::get('error') }}
        </div>
    @endif

    <h3 class="login-heading">Sign in</h3>
    @if( Session::has('success'))
    <div class="alert alert-danger alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	 {{ Session::get('success') }}
    </div>
    @endif
    <div class="login-form">
        <form data-toggle="validator" method="POST" action="{{ route('postLogin') }}">
            {{ csrf_field() }}

            <input type="hidden" name="type" id="type_login" value="member">
            <div class="code-login">
                <div class="form-group">
                    <label for="lmcode" class="control-label">Enter Member Code</label>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>

                    <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="phone-login" style="display: none;">
                <div class="form-group">
                    <label for="phone" class="control-label">Enter Contact No.</label>
                    <div class="input-group">
                        <input type="tel" name="phone" class="form-control" id="phone">
                        <div class="input-group-btn">
                            <span class="btn btn-default" id="send_otp_span">
                                Send OTP
                            </span>
                        </div>
                    </div>
            </div>


            <div class="form-group">
                    <label for="otp" class="control-label">Enter OTP</label>
                    <input id="otp" type="text" class="form-control" name="otp">
            </div>
            </div>

            {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Enter LM Code</label>
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required >
            @if ($errors->has('phone'))
            <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>
--}}

<div class="form-group">
    <button class="btn btn-primary btn-block" style="background:#d9230f;color:#FFFFFF" type="submit">Sign in</button>
</div>

<div class="form-group">
    <ul class="list-inline">
        {{-- <li><a href="{{ route('password.request') }}">Forgot password?</a></li> --}}
        <li>
            <button type="button" class="btn btn-link btn-phone">
                Login With Registered Phone
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-link btn-code" style="display: none;">
                Login With Member Code
            </button>
        </li>
    </ul>
</div>
</form>
</div>

@endsection
@section('footer-links')
    {{-- <li><a class="link-muted" href="{{ route('register') }}">Sign up</a></li> --}}
@endsection
