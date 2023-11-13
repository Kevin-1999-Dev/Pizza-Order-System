@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                <td><img src="{{ asset('storage/' . $c->product_image) }}" class="img-thumbnail shadow-sm"
                                        alt="" style="width: 50px;"></td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }}
                                    <input type="hidden" class="userId" value="{{ $c->user_id }}">
                                    <input type="hidden" class="cartId" value="{{ $c->id }}">
                                    <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                </td>
                                <td class="align-middle" id="price">{{ $c->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus text-white"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center"
                                            id="qty" value="{{ $c->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-2" id="totalPrice">{{ $c->pizza_price * $c->qty }} kyats</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger btnRemove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            <span class="text-white">Proceed To Checkout</span>
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">
                            <span class="text-white">Clear All</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('sortingSource')
    <script>
        $(document).ready(function() {

            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('kyats', ''));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#totalPrice').html(`${$total} kyats`);

                summary();

            })

            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('kyats', ''));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#totalPrice').html(`${$total} kyats`);

                summary();
            })

            $('.btnRemove').click(function() {
                $parentNode = $(this).parents('tr');
               $data =  $parentNode.find('.cartId').val();
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/remove/cart',
                    dataType : 'json',
                    data : { 'cart_id' : $data },
                    success : function(response){

                    }
                })

                $parentNode.remove();
                summary();


            })

            function summary() {
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#totalPrice').text().replace('kyats', ''))
                })

                $('#subTotalPrice').html(`${$totalPrice} kyats`)
                $('#finalPrice').html(`${$totalPrice+3000} kyats`)
            }

            // when order button click
            $('#orderBtn').click(function() {
                $orderList = [];
                $random = Math.floor(Math.random() * 1000001);

                $('#dataTable tbody tr').each(function(index, row) {

                    $userId = $(row).find('.userId').val();
                    $productId = $(row).find('.productId').val();
                    $qty = $(row).find('#qty').val();
                    $total = $(row).find('#totalPrice').text().replace('kyats', '') * 1;


                    $orderList.push({
                            'user_id': $userId,
                            'product_id': $productId,
                            'qty': $qty,
                            'total': $total,
                            'order_code': 'POS'+$random,
                        })
                })
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/order',
                    data : Object.assign({},$orderList),
                    dataType : 'json',

                    success : function(response){
                        if(response.status == 'true'){
                            window.location.href='/user/homePage'
                        }
                    }
                })
            })
            $('#clearBtn').click(function(){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/cart',
                    dataType : 'json'
                })

                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 kyats');
                $('#finalPrice').html('3000 kyats');
            })
        })
    </script>
@endsection
