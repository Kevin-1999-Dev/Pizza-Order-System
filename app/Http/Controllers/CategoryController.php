<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;






class CategoryController extends Controller
{
    //direct list page
    public function list()
    {
        $categories = Category::when(request('key'),function($query){
                        $query->where('name','like','%'. request('key') .'%');
        })->

                        orderBy('created_at','desc')->paginate(4);

        return view('admin.category.list',compact('categories'));
    }
    //direct create page
    public function createPage()
    {
        return view('admin.category.create');
    }
    //create category
    public function create(Request $request)
    {

        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);

        Category::create($data);
        return redirect()->route('category#list');
    }
    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>'Delete Success...']);
    }
    // edit page category
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    //update category
    public function update(Request $request){

        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }


    //category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId,
        ])->validate();
    }
    //get category Data
    private function getCategoryData(Request $request){
        return[
            'name'=>$request->categoryName,
        ];
    }

}
