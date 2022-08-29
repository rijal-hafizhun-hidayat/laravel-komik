<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function index()
    {
        return view('login/index');
    }

    public function sync(Request $request)
    {
        $data = $this->validation();
        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            $isAdmin = auth()->user()->is_admin;
            $request->session()->regenerate();

            $this->sessionSync($data, $isAdmin);

            //dd(auth()->user()->password);

            return redirect()->intended(route('komik.index'));
        } else {
            return redirect()->route('user.index')->with(['toast' => 'username atau password salah!']);
        }
    }

    public function validation()
    {
        $data = request()->validate(
            [
                '_token' => 'required',
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'form username wajib di isi',
                'password.required' => 'form password wajib di isi',
            ]
        );

        return $data;
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('user.index');
    }

    public function sessionSync($data, $isAdmin)
    {
        $data['isAdmin'] = $isAdmin;
        return request()->session()->put($data);
    }
}
