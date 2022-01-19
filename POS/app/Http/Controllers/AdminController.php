<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customers;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Invoice;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('ADMIN_LOGIN')){
            return redirect('/dashboard');
        }else{
            return view('admin.login');
        }
        
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
        $info['total_users'] = Customers::where('status','1')->count('id');
        $info['total_categories'] = Categories::count('id');
        $info['total_products'] = Products::where('status','1')->count('id');
        $info['total_suppliers'] = Suppliers::where('status','1')->count('id');
        $info['total_invoices'] = Invoice::where('status','1')->count('id');
        return view('admin.dashboard',$info);
    }

    
}
