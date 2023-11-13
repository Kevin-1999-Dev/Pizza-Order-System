@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                 @foreach ($order as $o )
                 <tbody class="align-middle">
                    <td class="align-middle" id="price">{{ $o->created_at->format('d-F-Y') }} </td>
                    <td class="align-middle" id="price">{{ $o->order_code }} </td>
                    <td class="align-middle" id="price">{{ $o->total_price }} kyats</td>
                    <td class="align-middle" id="price">
                        @if ($o->status == 0)
                            <span class="text-warning  fs-5">Pending...</span>
                        @elseif ($o->status == 1)
                            <span class="text-success  fs-5">Success</span>
                        @elseif ($o->status == 2)
                            <span class="text-danger  fs-5">Reject</span>
                        @endif
                    </td>
                </tbody>
                 @endforeach
                </table>
                <span>
                    {{ $order->links() }}
                </span>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection


