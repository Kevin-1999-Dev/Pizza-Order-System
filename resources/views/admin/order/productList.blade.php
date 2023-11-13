@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <a href="{{ route('admin#orderList') }}" class="text-dark"><i class="fa-solid fa-arrow-left-long"></i>
                        Back</a>

                    <div class="row col-5">
                        <div class="card ">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-circle-info me-2"></i>Order Info</h3>
                                <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row my-1">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                                    <div class="col">{{ $orderList[0]->user_name }}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col"><i class="fa-regular fa-clock me-2"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('d-F-Y') }}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                    <div class="col">{{ $order->total_price }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>




                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Order Id</th>
                                <th class="text-center">Product Image</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Order Date</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td class=" text-center">{{ $o->id }}</td>
                                    <td class=" text-center col-2"><img src="{{ asset('storage/' . $o->product_image) }}"
                                            alt=""></td>
                                    <td class=" text-center">{{ $o->product_name }}</td>
                                    <td class=" text-center">{{ $o->created_at->format('d-F-Y') }}</td>
                                    <td class=" text-center">{{ $o->qty }}</td>
                                    <td class=" text-center">{{ $o->total }}</td>


                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div>
                      {{ $pizzas->links() }}
                      </div> --}}
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
