<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\Units;




class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $query = DB::table('products');
        $query = $query->leftJoin('suppliers','suppliers.id' ,'=','products.supplier_id');
        $query = $query->leftJoin('categories','categories.id' ,'=','products.category_id');
        $query = $query->leftJoin('units','units.id' ,'=','products.unit_id');
        $query = $query->select('products.*','suppliers.name as sname','categories.name as catname','units.name as uname');
        $query = $query->orderBy('products.id','DESC');
        $query = $query->get();
        $result['data'] =  $query;
        return view('admin.products.products_list',$result);
    }

    public function add_form(){
        $data['supplier'] = Suppliers::all();
        $data['categories'] = Categories::all();
        $data['units'] = Units::all();
        return view('admin.products.add_products',$data);
    }

    public function add_product(Request $req){
        $supp = new Products;
        $supp->supplier_id = $req->post('supplier_id');
        $supp->category_id = $req->post('category_id');
        $supp->unit_id = $req->post('unit_id');
        $supp->name = $req->post('name');
        $supp->created_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Product Added Successfully');
        return redirect('/view_products');
    }

    public function delete(Request $req,$id){
       $result = Products::find($id);
       $result->delete();
       $req->session()->flash('message','Product Deleted Successfully');
       return redirect('/view_products');
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
