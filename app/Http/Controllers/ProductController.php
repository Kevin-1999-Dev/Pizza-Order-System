<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct list page
    public function list(){
       $pizzas =  Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){
                $query->where('products.name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                        ->orderBy('products.created_at','desc')
                        ->paginate(3);

       $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //direct create page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }
    //create pizza
    public function create(Request $request){
        $this->pizzaValidationCheck($request,"create");
        $data = $this->getPizzaData($request);
        $fileName = uniqid().$request->pizzaImage->getClientOriginalName();
        $request->pizzaImage->storeAs('public/'.$fileName);
        $data['image']=$fileName;
        Product::create($data);
        return redirect()->route('product#list');
    }
    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list');
    }
    //direct edit page
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')

        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //direct update page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //update pizza
    public function update(Request $request){

        $this->pizzaValidationCheck($request,"update");
        $data = $this->getPizzaData($request);

        if($request->hasFile('pizzaImage')){
           $oldImage = Product::where('id',$request->pizzaId)->first();
           $oldImage = $oldImage->image;


           if($oldImage != null){
            Storage::delete('public/'.$oldImage);
           }

           $fileName = uniqid(). $request->pizzaImage->getClientOriginalName();
           $request->pizzaImage->storeAs('public/'.$fileName);
           $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //create pizza validatiion check
    private function pizzaValidationCheck($request,$action){
        $validationRules = [
            'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required',

            'pizzaWaitingTime'=>'required',
            'pizzaPrice'=>'required',
        ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp|file' :  'mimes:png,jpg,jpeg,webp|file';
        Validator::make($request->all(),$validationRules)->validate();
    }
    //get pizza data
    private function getPizzaData($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
        ];
    }
}
