<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    public function adminLoginProcess(Request $req){
        $email = $req->post('email');
        $pass = $req->post('password');
        $result = admin::where('email',$email)->first();
        if($result){
          if (Hash::check($pass, $result->password)) {
            $req->session()->put('ADMIN_LOGIN',true);
            $req->session()->put('ADMIN_ID',$result->id);
            return redirect('dashboard');
          }else{
            $req->session()->flash('error','Please Enter Correct Password');
            return redirect('/');
          }
        }else{
           $req->session()->flash('error','Please Enter Valid Email Id');
           return redirect('/');
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    
}
