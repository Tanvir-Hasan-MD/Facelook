<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
use App\Model\UserRole;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Image;

class UserController extends Controller
{
    public function registration()
    {
        return view('backend.social.register');
    }
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed', 
        ]);
        // dd($request->all());
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($file = $request->file('image'))
        {
            // @unlink('public/upload/user_image/'.$user->image);
            $filename =date('Ymd') .'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_image'), $filename);
            $image=Image::make(public_path('upload/user_image/').$filename);
            $image->resize(230,230)->save(public_path('upload/user_image/').$filename);
            $data['image']= $filename;
        }
        $user = User::create($data);
        $data['user_id'] = $user['id'];
        $data['role_id'] = 22; //Client id 22
        UserRole::create($data);
        return redirect()->route('dashboard')->with('info','User Create successfully.');

    }
    public function profile()
    {
        $data['user'] = User::find(Auth::User()['id']);
        // dd($data['editData']);
        return view('backend.social.profile')->with($data);
    }
    public function profileEdit($id)
    {
        $data['editData'] = User::find($id);
        // dd($data['editData']->toArray());
        return view('backend.social.profile-edit')->with($data);
    }
    public function profileUpdate(Request $request)
    {
        $data = $request->all();

        $user = User::find(Auth::User()['id']);
        if ($file = $request->file('image'))
        {
            @unlink('public/upload/user_image/'.$user->image);
            $filename =date('Ymd') .'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_image'), $filename);
            $image=Image::make(public_path('upload/user_image/').$filename);
            $image->resize(230,230)->save(public_path('upload/user_image/').$filename);
            $data['image']= $filename;
        }
        $user->update($data);
        return redirect()->route('dashboard')->with('info','Profile successfully update.');
    }



}
