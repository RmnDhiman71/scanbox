<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // echo "<pre>";print_r($credentials);die;

        $credentials['is_admin'] = '1';
        
        if(Auth::attempt($credentials))
        {
            return back()->with('error', 'Your provided credentials do not match in our records.')->onlyInput('email');   
        }

        
        $user = auth()->user();
        // dd($user);   

        
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'You have successfully logged in!');
    } 

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
            // 'phone' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->identity_number = $request->identity_number;
        $user->update();

        return redirect()->back()->with('success', 'Profile Updated Successfully ...!!');
    }
}