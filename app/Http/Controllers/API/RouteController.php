<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList(){
        $product = Product::get();
        return response()->json($product,200);
    }
    public function categoryList(){
        $category = Category::get();
        return response()->json($category,200);
    }
    public function categoryCreate(Request $request){
        $data = [
            'name' => $request->name,
            'created_at'=> Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $response=Category::create($data);
        return response()->json($response,200);
    }
    public function contactCreate(Request $request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=> Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $response=Contact::create($data);
        $contact=Contact::orderBy('created_at','desc')->get();
        return response()->json($contact,200);
    }
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['message'=>'delete success'],200);
        }
        return response()->json(['message'=>'There is no category'],200);
    }

}
