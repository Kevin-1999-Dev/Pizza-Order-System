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

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Profile</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#accountChange',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-2">
                                    @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('image/user.png') }}" alt="" class="img-thumbnail shadow-sm col-12 ">
                                @else
                                    <img src="{{ asset('image/female.png') }}" alt="" class="img-thumbnail shadow-sm col-12 ">
                                @endif
                                    @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm col-12 "  />
                                    @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white mt-3 col-12" type="submit">Update</button>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" value="{{ old('name',Auth::user()->name) }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Your Name...">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" value="{{ old('email',Auth::user()->email) }}" name="email" type="text" class="form-control @error('email') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Your Email...">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Choose...</option>
                                        <option value="male " @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                         <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" value="{{ old('phone',Auth::user()->phone) }}" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone...">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>

                                   <div class="form-group">
                                        <label for="" class="control-label mb-1">Address</label>
                                        <textarea name="address"  class="form-control @error('address') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Your Address...">{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Role</label>
                                        <input type="text" name="role" value="{{ old('role',Auth::user()->role) }}"  class="form-control" disabled>
                                        {{-- @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror --}}
                                    </div>
                                </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
