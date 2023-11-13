<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category','cart','order'));
    }

    //direct user list page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    public function userChangeRole(Request $request){
        $updateSource = [
            'role' => $request->role,
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    // change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }


    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $data = User::select('password')->where('id', $id)->first();
        $data = $data->password;
        $currentPw = $request->oldPassword;
        if (Hash::check($currentPw, $data)) {
            User::where('id', $id)->update([
                'password' =>  Hash::make($request->newPassword)
            ]);
            Auth::logout();
            return redirect()->route('auth#login');
        }
        return back()->with(['doNotMatch' => 'The Old Password do not Match']);
    }

    // account profile
    public function accountChangePage()
    {
        return view('user.profile.account');
    }
    // update user profile
    public function accountChange($id,Request $request)
    {


        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }



        User::where('id', $id)->update($data);
        return back();
    }

    // filter pizza
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::get();
        return view('user.main.home', compact('pizza', 'category','cart','order'));
    }

    // direct to pizza details page
    public function pizzaDetails($pizzaId){
        $pizzaList = Product::where('id',$pizzaId)->first();
       $pizza =  Product::get();
        return view('user.main.details',compact('pizzaList','pizza'));
    }

    // cart list
    public function cartList(){
       $cartList =  Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price*$c->qty;
        }
        return view('user.cart.cart',compact('cartList','totalPrice'));
    }

    // direct to history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->paginate(4);

        return view('user.main.history',compact('order'));
    }

    // update validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    //  get data from admin update
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,

        ];
    }
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:12',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword',
        ])->validate();
    }
}
