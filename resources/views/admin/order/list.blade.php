@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                            <h3 class="text-warning">Total - {{ count($order) }}</h3>
                    </div>

                    {{-- <div class="row">
                        <div class="col-3  text-white text-center pt-2">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span> </h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('product#list') }}" method="get" >
                                <div class="d-flex">
                                 <input type="text" name="key" class="form-control " placeholder="Search..." value="{{ request('key') }}">
                                 <button class="btn btn-danger" type="submit" >
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                 </button>
                                </div>
                             </form>
                        </div>
                    </div> --}}
                    <form action="{{ route('admin#orderStatus') }}" method="post">
                        @csrf
                        <div class="d-flex ">
                            <label for="" class="mt-2 me-4">Order Status</label>
                            <select name="orderStatus" class="form-control col-2" >
                                <option value="" >All</option>
                                <option value="0" @if(request('orderStatus')=='0') selected @endif>Pending</option>
                                <option value="1" @if(request('orderStatus')=='1') selected @endif>Success</option>
                                <option value="2" @if(request('orderStatus')=='2') selected @endif>Reject</option>
                            </select>

                            <button type="submit" class="btn btn-sm text-white bg-dark"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                        </div>
                    </form>


                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" >
                      <thead>
                          <tr>
                              <th class="text-center">User ID</th>
                              <th class="text-center">User Name</th>
                              <th class="text-center">Date</th>
                              <th class="text-center">Order Code</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Status</th>
                          </tr>
                      </thead>
                      <tbody id="dataList">
                      @foreach ($order as $o )
                      <tr class="tr-shadow" >
                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                        <td class=" text-center">{{ $o->user_id }}</td>
                        <td class=" text-center">{{ $o->user_name }}</td>
                        <td class=" text-center">{{ $o->created_at->format('d-F-Y') }}</td>
                        <td class=" text-center">
                            <a href="{{ route('admin#linkInfo',$o->order_code) }}">{{ $o->order_code }}</a>
                        </td>
                        <td class=" text-center">{{ $o->total_price }}</td>
                        <td class=" text-center col-2">
                            <select name="status" class="form-control statusChange">
                                <option value="0" @if ($o->status == 0 ) selected @endif>Pending</option>
                                <option value="1" @if ($o->status == 1 ) selected @endif>Success</option>
                                <option value="2" @if ($o->status == 2 ) selected @endif>Reject</option>
                            </select>
                        </td>

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

@section('scriptSource')
    <script>
        $(document).ready(function(){

            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                }

                $.ajax({
                    type : 'get',
                    url : '/order/ajax/change/status',
                    data : $data,
                    dataType : 'json',
                })
                location.reload();


            })
        })
    </script>
@endsection
