@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
     <!-- MAIN CONTENT-->
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
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control  @error('oldPassword')
                                        is-invalid
                                    @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Your Old Password...">
                                    <div>@error('oldPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror</div>
                                    @if (session('doNotMatch'))
                                    <p class="text-danger">
                                        {{ session('doNotMatch') }}
                                    </p>

                                    @endif
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
    <!-- END MAIN CONTENT-->
@endsection
