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
        $data['current_date'] = date('Y-m-d');
    	return view('admin.invoice.add_form',$data);
    }

    public function invoiceStore(Request $req){
    	if($req->category_id == null){
    		$req->session()->flash('error','Please purchase product');
    		return redirect()->back();
    	}else{
    		if($req->estimated_amount<$req->paid_amount){
    			$req->session()->flash('error','Paid amount can never be greater than total amount');
    			return redirect()->back();
    		}else{
    			$invoice = new Invoice();
    			$invoice->invoice_no = $req->invoice_number;
    			$invoice->date = $req->date;
    			$invoice->description = $req->description;
    			$invoice->status = '0';
    			$invoice->created_by = $req->session()->get('ADMIN_ID');
    			DB::transaction(function() use($req,$invoice) {
    				if($invoice->save()){
    					$count_category = count($req->category_id);
    					for($i=0; $i<$count_category; $i++){
    						$invoice_details = new InvoiceDetail();
    						$invoice_details->date = $req->date;
    						$invoice_details->invoice_id = $req->invoice_number;
    						$invoice_details->category_id = $req->category_id[$i];
    						$invoice_details->product_id = $req->product_id[$i];
    						$invoice_details->selling_qty = $req->selling_qty[$i];
    						$invoice_details->unit_price = $req->unit_price[$i];
    						$invoice_details->selling_price = $req->selling_price[$i];
    						$invoice_details->status = '0';
    						$invoice_details->created_at = $req->session()->get('ADMIN_ID');
    						$invoice_details->save();
    					}
    					$payment = new Payment();
    					$paymentDetail = new PaymentDetail();

    					$payment->invoice_id = $req->invoice_number;
    					$payment->customer_id = $req->customer_id;
    					$payment->discount_amount = $req->discount_amount;
    					if($req->paid_status == 'paid'){
    						$payment->paid_status = 'paid';
    						$payment->paid_amount = $req->estimated_amount;
    						$payment->due_amount = '0';
    						$payment->total_amount = $req->estimated_amount;
    						$paymentDetail->current_paid_amount = $req->estimated_amount;
    					}elseif($req->paid_status == 'due'){
    						$payment->paid_status = 'due';
    						$payment->paid_amount = '0';
    						$payment->due_amount = $req->estimated_amount;
    						$payment->total_amount = $req->estimated_amount;
    						$paymentDetail->current_paid_amount = '0';
    					}else{
    						$payment->paid_status = 'partital_paid';
    						$payment->paid_amount = $req->paid_amount;
    						$payment->due_amount = $req->estimated_amount - $req->paid_amount;
    						$payment->total_amount = $req->estimated_amount;
    						$paymentDetail->current_paid_amount = $req->paid_amount;
    					}
    					$payment->save();
    					$paymentDetail->invoice_id = $req->invoice_number;
    					$paymentDetail->date = $req->date;
    					$paymentDetail->save();
    				}
    			});
    		}
    		$req->session()->flash('message','Invoice created successfully');
    		return redirect('/view_invoice');
    	}
    }

}