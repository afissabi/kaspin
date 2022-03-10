<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Models\M_user;
use Exception;
use App\Models\master\M_menu_user;
use App\Models\master\M_menu;
use App\Models\master\M_role;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = M_user::where(function ($query) use ($request) {
            $query->where('username', $request->input('username'));
        })->where(function ($query) {
            $query->where('is_aktif', '1');
        })->first();
        
        if ($user && Hash::check($request->input('password'), $user->password)) {
            
            Session::put('user', $user);

            return redirect('/dashboard');
        } else {
            return back()->with('status', 'Maaf, kombinasi username dan password Anda salah');
        }
    }

    public function logout()
    {
        session()->forget('user');
        session()->flush();

        return redirect('/login');
    }   

}
