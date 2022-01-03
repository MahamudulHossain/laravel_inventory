<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;


class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Suppliers::all();

        return view('admin.suppliers.suppliers_list',compact('data'));
    }

    public function add_form(){
        return view('admin.suppliers.add_suppliers');
    }

    public function add_supplier(Request $req){
        $supp = new Suppliers;
        $supp->name = $req->post('name');
        $supp->mobile_no = $req->post('mobile_no');
        $supp->email = $req->post('email');
        $supp->address = $req->post('address');
        $supp->created_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Supplier Added Successfully');
        return redirect('/view_suppliers');
    }

    public function delete(Request $req,$id){
       $result = Suppliers::find($id);
       $result->delete();
       $req->session()->flash('message','Supplier Deleted Successfully');
       return redirect('/view_suppliers');
    }

    public function edit_form(Request $req,$id){
        $data = Suppliers::find($id);
        return view('admin.suppliers.edit_supplier',compact('data'));
    }

    public function update_supplier(Request $req,$id){
        $supp = Suppliers::find($id);
        $supp->name = $req->post('name');
        $supp->mobile_no = $req->post('mobile_no');
        $supp->email = $req->post('email');
        $supp->address = $req->post('address');
        $supp->updated_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Supplier Updated Successfully');
        return redirect('/view_suppliers');
    }
    
}
