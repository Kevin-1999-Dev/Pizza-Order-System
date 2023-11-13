@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('image/user.png') }}" alt="">
                                @else
                                    <img src="{{ asset('image/female.png') }}" alt="">
                                @endif
                                    @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4> <i class="fa-solid fa-user me-2 my-2"></i> {{ Auth::user()->name }}</h4>
                                    <h4> <i class="fa-solid fa-envelope me-2 my-2"></i> {{ Auth::user()->email }}</h4>
                                    <h4> <i class="fa-solid fa-phone me-2 my-2"></i> {{ Auth::user()->phone }}</h4>
                                    <h4> <i class="fa-solid fa-location-dot me-2 my-2"></i> {{ Auth::user()->address }}</h4>
                                    <h4> <i class="fa-solid fa-mars-and-venus me-2 my-2"></i> {{Auth::user()->gender}}  </h4>
                                    <h4> <i class="fa-solid fa-user-clock me-2 my-2"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 offset-2">
                                   <a href="{{ route('admin#editPage') }}">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                                    </button>
                                   </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
