<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Business\AdminBusiness;
use App\Http\Business\RoleBusiness;

class login extends Controller
{
    private $AdminBusiness;
    private $RoleBusiness;
    public function __construct(AdminBusiness $adminBusiness, RoleBusiness $roleBusiness) {
        $this->AdminBusiness = $adminBusiness;
        $this->RoleBusiness = $roleBusiness;
    }

    public function signin() {
        if(session('admin') == null)
            return view('login');
        return redirect(route('admin'));
    }

    public function signinPost(Request $request) {
        if(session('admin') != null)
            return redirect(route('admin'));
        $email = $request->input('email');
        $password = $request->input('password');
        $admin = $this->AdminBusiness->singleEmailPassword($email, $password);

        if($admin == null) {
            return view('login',
            [
                'error', 'email hoặc mật khẩu không đúng',
                'email' => $email,
                'password' => $password
            ]);
        }
        $admin->Role = $this->RoleBusiness->singleId($admin->RoleId);
        session()->put('admin',$admin);
        return redirect(route('admin'));
    }

    public function logout() {
        session()->forget('admin');
        return redirect(route('home'));
    }
}
