<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function orderList(){
       $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->get();

        return view('admin.order.list',compact('order'));
    }

    // ajax status
    public function orderStatus(Request $request){


        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');


        if($request->orderStatus == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    public function statusChange(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->get();

return view('admin.order.list',compact('order'));
    }

    //link Info for order code
    public function linkInfo($orderCode){

        $order = Order::where('order_code',$orderCode)->first();

        $orderList = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','users.name as user_name')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_lists.order_code',$orderCode)
                    ->get();

        return view('admin.order.productList',compact('orderList','order'));
    }
}
