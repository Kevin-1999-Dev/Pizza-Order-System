<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



/**
 * Summary of AdminController
 */
class AdminController extends Controller
{
     // change password page
     public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $data =User::select('password')->where('id',$id)->first();
        $data = $data->password;
        $currentPw = $request->oldPassword;
        if(Hash::check($currentPw,$data)){
            User::where('id',$id)->update([
              'password'=>  Hash::make($request->newPassword)
            ]);
            Auth::logout();
            return redirect()->route('auth#login');
        }
        return back()->with(['doNotMatch'=>'The Old Password do not Match']);

    }
    //direct account details page
    public function details(){
        return view('admin.account.details');
    }

    //direct account edit page
    public function editPage(){
        return view('admin.account.edit');
    }

    //update admin profile
    public function updateData($id,Request $request){


        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }



        User::where('id',$id)->update($data);
        return redirect()->route('admin#details');

    }

    //direct to admin list page
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%')
            ->orWhere('phone','like','%'.request('key').'%')
            ->orWhere('address','like','%'.request('key').'%')
            ->orWhere('role','like','%'.request('key').'%');

        })
                ->where('role','admin')
                ->paginate(3);
        return view('admin.account.list',compact('admin'));
    }

    //delete admin list
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success...']);
    }

    //direct to changeRole page
    public function changeRole($id){
       $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change admin role
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //requset user data for admin change role
    private function requestUserData($request){
        return [
            'role'=>$request->role
        ];
    }

// update validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'gender'=>'required',
        ])->validate();
    }

//  get data from admin update
 private function getUserData($request)
 {
    return [
        'name'=>$request->name,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'gender'=>$request->gender,
        'email'=>$request->email,

    ];
 }
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:12',
            'newPassword'=>'required|min:6|max:12',
            'confirmPassword'=>'required|min:6|max:12|same:newPassword',
        ])->validate();
    }
}
