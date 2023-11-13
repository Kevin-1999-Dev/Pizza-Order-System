{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>This is User Home Page</h3>
    <h4>Role - {{ Auth::user()->role }}</h4>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="Logout">
    </form>

</body>
</html> --}}
@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        @if (session('doNotMatch'))
                        <p class="text-danger">
                            {{ session('doNotMatch') }}
                        </p>

                        @endif
                        <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control  @error('oldPassword')
                                    is-invalid
                                @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Your Old Password...">
                                <div>@error('oldPassword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror</div>

                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control  @error('newPassword') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Your New Password...">
                               <div>
                                @error('newPassword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                               </div>
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control  @error('confirmPassword')
                                    is-invalid
                                @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Your Confirm Password...">
                                @error('confirmPassword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
