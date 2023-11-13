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
                                <h3 class="text-center title-2">Product Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" />
                                </div>
                                <div class="col-5 offset-1">
                                    <h4> <i class="fa-solid fa-signature me-2 my-2"></i> {{ $pizza->name }}</h4>
                                    <h4> <i class="fa-solid fa-money-bill-1-wave me-2 my-2"></i> {{ $pizza->price }}</h4>
                                    <h4> <i class="fa-solid fa-clock me-2 my-2"></i> {{ $pizza->waiting_time }}</h4>
                                    <h4> <i class="fa-regular fa-copy me-2 my-2"></i> {{ $pizza->category_name }}</h4>
                                    <h4> <i class="fa-solid fa-eye me-2 my-2"></i> {{ $pizza->view_count }}</h4>
                                    <h4> <i class="fa-solid fa-user-clock  me-2 my-2"></i> {{ $pizza->created_at->format('j-F-Y') }}</h4>
                                    <h4> <i class="fa-solid fa-file-waveform me-2 my-2"></i> {{ $pizza->description }}  </h4>
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
