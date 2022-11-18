<style>

    .nk-auth-body, .nk-auth-footer{

        max-width: 100% !important;

    }
   
 .login-section.container {

    max-width: 1100px !important;

}

.login-section .right-col {

    box-shadow: #0000000f 0px 1px 10px;

    padding: 30px;

    border-radius: 20px;

}



.login-section h5.nk-block-title {

    font-size: 30px;

    color: #414042;

}



.login-section .nk-block-des p {

    font-size: 16px;

    color: #414042;

    line-height: 25px;

    margin: 8px 0px;

}



.login-section .form-control-lg {

    width: 100%;

    border-radius: 5px;

}



.login-section label.form-label {

    font-size: 16px;

    color: #414042;

}



.login-section .form-control-lg::placeholder {

    font-size: 16px;

    color: #C7CACE;

    font-weight: 500;

}



img.mrm-login-white {
    position: absolute;
    top: 50px;
    left: 18%;
}





button.btn.btn-lg.btn-primary.btn-block {

    width: 120px;

    height: 45px;

}



a.link.link-primary.link-sm {

    margin: 20px 0px;

    margin-left: 20px;

    font-size: 16px;

    color: #4D525B !important;

    font-weight: 500;

}



.mrm-lgoo {

    max-width: 1250px !important;

}



.login-section .left-col img {padding-right: 15%;}



@media screen and (max-width:992px){

img.mrm-login-white {top: -75px;}

}

@media screen and (max-width:1500px){
.login-section.container {
    margin-top: 150px;
}
}




@media screen and (max-width:768px){

.login-section.container {

    margin-top: 100px;

}



img.mrm-login-white {

    top: 0px;

    position: unset;

    margin-top: 0px;

}



.left-col {

    margin-bottom: 50px;

}


.login-section.container {
    margin-top: 0px;
}

}


.dark-mode img.mrm-login-white {
display:none;

}



img.mrm-logo-black {
    display: none;
}

.dark-mode img.mrm-logo-black {
    display: block;
    position: absolute;
    top: 50px; 
    left: 18%;
}

.col-md-6.left-col {
    position: unset;
}

.login-section .right-col {
    box-shadow: #ffffff87 0px 1px 10px;
}

.login-section h5.nk-block-title {
    color: #fff;
}

.login-section .nk-block-des p {
    color: #fff;
}

a.link.link-primary.link-sm {
    color: #bbbbbb !important;
}



.dark-mode  .login-section .right-col {
    box-shadow: #ffffff87 0px 1px 10px;
}

.dark-mode  .login-section h5.nk-block-title {
    color: #fff;
}

.dark-mode  .login-section .nk-block-des p {
    color: #fff;
}

.dark-mode  a.link.link-primary.link-sm {
    color: #bbbbbb !important;
}


img.mrm-login-white {
    position: absolute;
    top: 50px;
    left: 16%;
}
</style>





@extends('layouts.authpages')



@section('content')





 

<div class ="container mrm-lgoo">

<img class ="mrm-login-white" src="{{asset('assets/images/[LOGO].png')}}" >

</div>



<div class = "login-section container">





<div class ="row">



<div class ="col-md-6 left-col">

<img src="{{asset('assets/images/img-login.png')}}" alt="login" class ="img-fluid">
<img class ="mrm-logo-black"  src="{{asset('assets/images/mrm-logo-dark.png')}}" >
</div>



<div class ="col-md-5 right-col">

<div class="nk-block-head">
                        <div class="nk-block-head-content">

                            <h5 class="nk-block-title">Sign-In</h5>

                            <div class="nk-block-des">

                                <p>Access dashboard using your email and password.</p>

                            </div>

                        </div>

                    </div><!-- .nk-block-head -->

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <div class="form-group">

                            <div class="form-label-group">

                                <label class="form-label" for="default-01">Email</label>

                            </div>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address">



                            @error('email')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                        </div><!-- .foem-group -->

                        <div class="form-group">

                            <div class="form-label-group">

                                <label class="form-label" for="password">Password</label>

                               

                            </div>

                            <div class="form-control-wrap">

                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">

                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>

                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>

                                </a>

                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your passcode">



                                @error('password')

                                <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div><!-- .foem-group -->

                        <div class="form-group">

                            <button class="btn btn-lg btn-primary btn-block">Sign in</button>     

                             @if (Route::has('password.request'))

                                    <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>

                            @endif

                        </div>

                    </form><!-- form -->

{{--                    <div class="form-note-s2 pt-4"> New on our platform? <a href="{{ route('register') }}">Create an account</a>--}}

{{--                    </div>--}}

{{--                    <div class="text-center mt-5">--}}

{{--                        <span class="fw-500">I don't have an account? <a href="{{ route('register') }}">Try 15 days free</a></span>--}}

{{--                    </div>--}}



</div>









</div>





</div>



                  

@endsection

