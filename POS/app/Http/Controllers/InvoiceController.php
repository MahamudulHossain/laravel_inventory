<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\Units;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomersController;


class InvoiceController extends Controller
{
    public function show()
    {
        $allData = Invoice::get();
        return view('admin.invoice.invoice_list',compact('allData'));
    }
    public function add_form(){
        $data['categories'] = Categories::all();
        $data['customers'] = DB::table('customers')->get();
        $invoiceData = Invoice::orderBy('id','desc')->first();
        if($invoiceData == null){
        	$invoiceReg = '0';
        	$data['invoice_no'] = $invoiceReg+1;
        }else{
	        $invoiceData = Invoice::orderBy('id','desc')->first()->invoice_no;
        	$data['invoice_no'] = $invoiceData+1;
        }
    	return view('admin.invoice.add_form',$data);
    }

}
