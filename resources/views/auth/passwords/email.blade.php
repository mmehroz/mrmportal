<style>

    .nk-auth-body, .nk-auth-footer{

        max-width: 100% !important;

    }

   

 .login-section.container {
    max-width: 1100px !important;
    margin-top: 79px;
}



.login-section .left-col img {padding-right: 15%;}



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









button.btn.btn-lg.btn-primary.btn-block {

    width: 200px;

    height: 45px;

}



a.link.link-primary.link-sm {

    float: right;

    margin: 20px 0px;

    font-size: 16px;

    color: #4D525B !important;

    font-weight: 500;

}



.return-opt a {

    float: right;

    margin-top: -45px;

    color: #4D525B !important;

}



.mrm-lgoo {

    max-width: 1250px !important;

}



}


    img.mrm-login-white {
    position: absolute;
    top: 50px;
    left: 18%;
}


@media screen and (max-width:1500px){
.login-section.container {
    margin-top: 150px;
}
}



@media screen and (max-width:992px){

img.mrm-login-white {top: -75px;}

}





@media screen and (max-width:768px){

.login-section.container {

    margin-top: 100px;
}

.login-section.container {
    margin-top:0px;
}


img.mrm-login-white {

    top: 0px;

    position: unset;

    margin-top: 0px;

}



.left-col {

    margin-bottom: 50px;

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



.login-section .right-col {
    box-shadow: #ffffff87 0px 1px 10px;
    padding: 30px;
    border-radius: 20px;
    height: fit-content;
    margin: 8% 0%;
}

strong {
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
<img class ="mrm-logo-black"  src="{{asset('assets/images/mrm-logo-dark.png')}}" >
</div>



<div class ="login-section container">



<div class ="row">

<div class ="col-md-6 left-col">

<img class ="mrm-login" src="{{asset('assets/images/img-login.png')}}" >

</div>

<div class ="col-md-5 right-col">

<div class="nk-block-head">

        <div class="nk-block-head-content">

            <h5 class="nk-block-title">   Reset password</h5>

            <div class="nk-block-des">

                <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>

            </div>

            @if (session('status'))

                <div class="alert alert-success" role="alert">

                    {{ session('status') }}

                </div>

            @endif

        </div>

    </div><!-- .nk-block-head -->

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

        <div class="form-group">

            <div class="form-label-group">

                <label class="form-label" for="default-01">Email</label>

            </div>

            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address">



            @error('email')

            <span class="invalid-feedback" role="alert">

                <strong>{{ $message }}</strong>

            </span>

            @enderror

        </div>

            <button type="submit"  class="btn btn-lg btn-primary btn-block">Send Reset Link</button>

      

    </form><!-- form -->

    <div class="form-note-s2 return-opt">

        <a href="{{ route('login') }}"><strong>Return to login</strong></a>

    </div>

</div>

</div>



</div>



  







{{--<div class="container">--}}

{{--    <div class="row justify-content-center">--}}

{{--        <div class="col-md-8">--}}

{{--            <div class="card">--}}

{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}



{{--                <div class="card-body">--}}

{{--                    @if (session('status'))--}}

{{--                        <div class="alert alert-success" role="alert">--}}

{{--                            {{ session('status') }}--}}

{{--                        </div>--}}

{{--                    @endif--}}



{{--                    <form method="POST" action="{{ route('password.email') }}">--}}

{{--                        @csrf--}}



{{--                        <div class="form-group row">--}}

{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}



{{--                            <div class="col-md-6">--}}

{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}



{{--                                @error('email')--}}

{{--                                    <span class="invalid-feedback" role="alert">--}}

{{--                                        <strong>{{ $message }}</strong>--}}

{{--                                    </span>--}}

{{--                                @enderror--}}

{{--                            </div>--}}

{{--                        </div>--}}



{{--                        <div class="form-group row mb-0">--}}

{{--                            <div class="col-md-6 offset-md-4">--}}

{{--                                <button type="submit" class="btn btn-primary">--}}

{{--                                    {{ __('Send Password Reset Link') }}--}}

{{--                                </button>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </form>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}

{{--</div>--}}

@endsection

