<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $allData = DB::table('purchases')
                   ->join('Suppliers','Suppliers.id','=','purchases.supplier_id') 
                   ->join('Categories','Categories.id','=','purchases.category_id') 
                   ->join('products','products.id','=','purchases.product_id')
                   ->select('purchases.*','Suppliers.name as supNm','Categories.name as catNm','products.name as proNm') 
                   ->get();
        return view('admin.purchase.purchase_list',compact('allData'));
    }

    public function add_form(){
        $data['supplier'] = Suppliers::all();
        $data['categories'] = Categories::all();
        $data['units'] = Units::all();
        return view('admin.purchase.purchase_now',$data);
    }

    public function purchase_now(Request $req){

        $category_id = $req->category_id;
        if($category_id > 0){
             for($i=0; $i < count($req->category_id); $i++){
                 $data = new Purchase();
                 $data->supplier_id = $req->supplier_id[$i];
                 $data->category_id = $req->category_id[$i];
                 $data->product_id = $req->product_id[$i];
                 $data->purchase_no = $req->purchase_no[$i];
                 $data->date = date('Y-m-d',strtotime($req->date[$i]));
                 $data->description = $req->desc[$i];
                 $data->buying_qty = $req->buying_qty[$i];
                 $data->unit_price = $req->unit_price[$i];
                 $data->buying_price = $req->buying_price[$i];
                 $data->status = '0';
                 $data->created_by = $req->session()->get('ADMIN_ID');
                 $data->save();
             }
            $req->session()->flash('message','Purchase list updated');
            return redirect('/view_purchase'); 
        }else{
             $req->session()->flash('error','Please! Buy atleast one product'); 
            return redirect()->back();
        }
    }

    public function delete(Request $req,$id){
       $result = Purchase::find($id);
       $result->delete();
       $req->session()->flash('message','Item Deleted Successfully');
       return redirect('/view_purchase');
    }
 

    public function update_status(Request $req,$id){
        //Updating qty in product table
        $purchase = Purchase::find($id);
        $product = Products::where('id',$purchase->product_id)->first();
        $product_qty = (($product->quantity) + ($purchase->buying_qty));
        $product->quantity = $product_qty;
        if($product->save()){
            //Updating purchase status
            $res = DB::table('purchases')
                   ->where('id',$id)
                   ->update(['status' => '1']);
        } 
        $req->session()->flash('message','Item Approved Successfully');
       return redirect('/view_purchase');       
    }
    
}
