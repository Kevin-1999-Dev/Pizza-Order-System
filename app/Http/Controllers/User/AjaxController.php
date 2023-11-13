<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request){
        if($request->status == 'asc' ){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }

        return $data;
    }

    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'status' => 'Complete Success'
        ];
        return response()->json($response,200);
    }

    //order
    public function order(Request $request){
        // logger($request[0]['user_id']);
        $total =0;
       foreach($request->all() as $item){
           $data= OrderList::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code']
            ]);

            $total += $data->total;
       }
       Cart::where('user_id',Auth::user()->id)->delete();

       Order::create([
        'user_id'=>$data->user_id,
        'order_code'=>$data->order_code,
        'total_price'=>$total+3000,

       ]);
       return response()->json([
        'status'=>'true',
        'message'=>'order complete',
       ],200);
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //When remove btn click
    public function removeCart(Request $request){
       $id = $request->cart_id;
       Cart::where('id',$id)->delete();
    }

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count
        ];
    }

    public function viewCount(Request $request){
       $pizza =  Product::where('id',$request->productId)->first();
        $count = [
            'view_count'=>$pizza->view_count+1,
        ];
       Product::where('id',$request->productId)->update($count);


    }
}
