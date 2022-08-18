<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Session;
use Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        // dd('dd');
        return view('/login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required|max:10|min:5'
        ]);
        // dd($request);
        $user = Role::where('role_id', '=', $request->role_id)->where('email', '=', $request->email)->where('password', '=', $request->password)->first();
        // dd($user);

        if($user)
        {
            // dd($user->role_id);
            if(($user->role_id == '1'))
            {
                 $request->session()->put('loginId',$user->id);
                 return view('admin.dashboard');
            }

            elseif(($user->role_id == 2) && ($user->email) && ($user->password))
            {
            $request->session()->put('loginId',$user->id);
            return redirect('account.dashboard');
            }

            else
            {
                return back()->with('fail', 'Invalid Email or Password');
            }

        }

        else
        {
            return back()->with('fail', 'Invalid Email or Password');
        }
    }

   public function logout(){

            Session::flush();
            return redirect('/');
        }

        public function dashboard()
         {

        return view('admin.dashboard');
         }
    }