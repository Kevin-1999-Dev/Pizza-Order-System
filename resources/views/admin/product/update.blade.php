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
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div>
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    </div>
                                    <div class="col-4 offset-2">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm col-12"  />
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white mt-3 col-12" type="submit">Update</button>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" value="{{ old('pizzaName',$pizza->name) }}" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror "aria-required="true" aria-invalid="false" >
                                            @error('pizzaName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription"  class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10" >{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Category...</option>
                                            @foreach ($category as $c )
                                                <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                            @endforeach

                                            </select>
                                            @error('pizzaCategory')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                             <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" value="{{ old('pizzaPrice',$pizza->price) }}" name="pizzaPrice" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('pizzaPrice')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                           <input id="cc-pament" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" name="pizzaWaitingTime" type="text" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                           @error('pizzaWaitingTime')
                                           <div class="invalid-feedback">{{ $message }}</div>
                                       @enderror
                                       </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">View Count</label>
                                            <input type="text" name="pizzaViewCount" value="{{ old('pizzaViewCount',$pizza->view_count) }}"  class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Created Date</label>
                                            <input type="text" name="pizzaCreated" value="{{ old('pizzaCreated',$pizza->created_at->format('j-F-Y')) }}"  class="form-control" disabled>
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
