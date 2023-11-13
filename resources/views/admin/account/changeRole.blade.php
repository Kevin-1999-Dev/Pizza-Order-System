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
                            <div class="ms-2" onclick="history.back()">
                                <i class="fa-solid fa-arrow-left" ></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-2">
                                        @if ($account->image == null)
                                        @if ($account->gender == 'male')
                                        <img src="{{ asset('image/user.png') }}" alt="">
                                    @else
                                        <img src="{{ asset('image/female.png') }}" alt="">
                                    @endif
                                        @else
                                        <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail shadow-sm col-12"  />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white mt-3 col-12" type="submit">Change</button>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" value="{{ old('name',$account->name) }}" name="name" disabled type="text" class="form-control @error('name') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Your Name...">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" value="{{ old('email',$account->email) }}" name="email" disabled type="text" class="form-control @error('email') is-invalid @enderror"   aria-required="true" aria-invalid="false" placeholder="Enter Your Email...">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose...</option>
                                            <option value="male " @if ($account->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                             <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" value="{{ old('phone',$account->phone) }}" name="phone" disabled type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone...">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                       <div class="form-group">
                                            <label for="" class="control-label mb-1">Address</label>
                                            <textarea name="address" disabled  class="form-control @error('address') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Your Address...">{{ old('address',$account->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                            </select>
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
    </div>
    <!-- END MAIN CONTENT-->
@endsection
