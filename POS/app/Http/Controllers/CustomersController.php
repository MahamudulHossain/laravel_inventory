<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Customers::all();

        return view('admin.customers.customers_list',compact('data'));
    }

    public function add_form(){
        return view('admin.customers.add_customers');
    }

    public function add_customer(Request $req){
        $supp = new Customers;
        $supp->name = $req->post('name');
        $supp->mobile_no = $req->post('mobile_no');
        $supp->email = $req->post('email');
        $supp->address = $req->post('address');
        $supp->created_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Customer Added Successfully');
        return redirect('/view_customers');
    }

    public function delete(Request $req,$id){
       $result = Customers::find($id);
       $result->delete();
       $req->session()->flash('message','Customer Deleted Successfully');
       return redirect('/view_customers');
    }

    public function edit_form(Request $req,$id){
        $data = Customers::find($id);
        return view('admin.customers.edit_customer',compact('data'));
    }

    public function update_customer(Request $req,$id){
        $supp = Customers::find($id);
        $supp->name = $req->post('name');
        $supp->mobile_no = $req->post('mobile_no');
        $supp->email = $req->post('email');
        $supp->address = $req->post('address');
        $supp->updated_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Customer Updated Successfully');
        return redirect('/view_customers');
    }

    public function creditCustomers(){
        $data = Payment::whereIn('paid_status',['due','partital_paid'])->get();
        return view('admin.customers.credit_customer',compact('data'));
    }
}
