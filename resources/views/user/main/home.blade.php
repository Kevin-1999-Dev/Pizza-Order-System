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
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom- d-flex align-items-center justify-content-between mb-3">

                            <label class="label" for="price-all">Categories</label>
                            <span class="badge border font-weight-bolder text-dark">{{ count($category) }}</span>
                        </div>
                        <div class="custom-control  d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}">
                                <label class="label text-dark" for="price-1">All</label>
                            </a>
                        </div>

                       @foreach ($category as $c )
                       <div class="custom-control  d-flex align-items-center justify-content-between mb-3">

                        <a href="{{ route('user#filter',$c->id) }}">
                            <label class="label text-dark" for="price-1">{{ $c->name }}</label>
                        </a>

                    </div>
                       @endforeach
                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                               <a href="{{ route('user#cartList') }}">
                                <button type="button" class="btn btn-dark position-relative">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($cart) }}
                                    </span>
                                  </button>
                               </a>

                               <a href="{{ route('user#history') }}" class="ms-3">
                                <button type="button" class="btn btn-dark position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i> History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($order) }}
                                    </span>
                                  </button>
                               </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button class="btn"><i class="fa-solid fa-sort"></i></button>
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        {{-- <option value="">Choose One Option...</option> --}}
                                        <option value="asc">Ascending</option>
                                        <option value="desc" selected>Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <span class="row" id="dataList">
                     @if (count($pizza)!=0)
                     @foreach ($pizza as $p )
                     <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/'.$p->image) }}" alt="">
                               <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <span class="text-muted">{{ $p->price }} kyats</span>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endforeach
                     @else
                         <p class="text-center fs-1 shadow-lg col-6 offset-3">There is no Pizza <i class="fa-solid fa-pizza-slice"></i></p>
                     @endif
                    </span>


                </div>
            </div>


            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('sortingSource')
    <script>
        $(document).ready(function(){
            $('#sortingOption').change(function(){
                $eventOp = $('#sortingOption').val()
                if($eventOp == 'asc'){
                    $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizza/list',
                    dataType : 'json',
                    data : { 'status' : 'asc' },
                    success : function(response){
                        $list = '';
                        for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                           <div class="product-item bg-light mb-4">
                               <div class="product-img position-relative overflow-hidden">
                                   <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                  <div class="product-action">
                                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>

                                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                   </div>
                               </div>
                               <div class="text-center py-4">
                                   <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                   <div class="d-flex align-items-center justify-content-center mt-2">
                                       <h5>${response[$i].price}</h5>
                                   </div>
                               </div>
                           </div>
                       </div>
                            `
                        }
                        $('#dataList').html($list);
                    }
                })
                }else{
                    $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizza/list',
                    dataType : 'json',
                    data : { 'status' : 'desc' },
                    success : function(response){
                        $list = '';
                        for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                           <div class="product-item bg-light mb-4">
                               <div class="product-img position-relative overflow-hidden">
                                   <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                  <div class="product-action">
                                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>

                                       <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                   </div>
                               </div>
                               <div class="text-center py-4">
                                   <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                   <div class="d-flex align-items-center justify-content-center mt-2">
                                       <h5>${response[$i].price}</h5>
                                   </div>
                               </div>
                           </div>
                       </div>
                            `
                        }
                        $('#dataList').html($list);
                    }
                })
                }
            })
        })
    </script>
@endsection
