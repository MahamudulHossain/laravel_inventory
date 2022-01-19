<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentDetail;
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

    public function creditCustomerPdf(){
        $data = Payment::whereIn('paid_status',['due','partital_paid'])->get();
        $pdf = PDF::loadView('admin.pdf.creditCustomerPdf', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function update_credit_customer($invoiceID,$cusID){
        $allData['cutomerData'] = Customers::where('id',$cusID)->first();
        $allData['invoice_no'] = $invoiceID;
        $allData['details'] = DB::table('invoices') 
                              ->join('invoice_details','invoice_details.invoice_id','=','invoices.invoice_no')
                              ->join('payments','payments.invoice_id','=','invoices.invoice_no')
                              ->select('invoice_details.id as inDId','invoice_details.category_id as catID','invoice_details.product_id as proID','invoice_details.selling_qty as sQuan','invoice_details.unit_price as uPrice','invoice_details.selling_price as sPrice','payments.paid_amount as pAmount','payments.due_amount as dueAmount','payments.total_amount as tAmount','payments.discount_amount as disAmount')
                              ->where('invoices.invoice_no',$invoiceID)
                              ->get();

        return view('admin.customers.update_credit_customer',$allData);
    }

    public function store_credit_customer(Request $req, $invoiceNo){
        $payment = Payment::where('invoice_id',$invoiceNo)->first();
        if($payment->due_amount < $req->paid_amount){
            $req->session()->flash('msg','Paid amount can never be greater than due amount');
                return redirect()->back();
        }else{
            $payment_details = new PaymentDetail;
            if($req->paid_status == 'paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoiceNo)->first()['paid_amount'] + $req->due_amount;
                $payment->due_amount = 0;
                $payment->paid_status = 'paid';
                $payment_details->current_paid_amount = $req->due_amount;
            }else{
                $payment->paid_amount = Payment::where('invoice_id',$invoiceNo)->first()['paid_amount'] + $req->paid_amount;
                $payment->due_amount = $req->due_amount - $req->paid_amount;
                $payment_details->current_paid_amount = $req->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoiceNo;
            $payment_details->date = $req->date;
            $payment_details->updated_by = $req->session()->get('ADMIN_ID');
            $payment_details->save();

            $req->session()->flash('message','Customer credit updated successfully');
            return redirect('/credit_customers');
        }
    }

    public function customar_credit_customer($invoiceID,$cusID){
        $allData['cutomerData'] = Customers::where('id',$cusID)->first();
        $allData['invoice_no'] = $invoiceID;
        $allData['details'] = DB::table('invoices') 
                              ->join('invoice_details','invoice_details.invoice_id','=','invoices.invoice_no')
                              ->join('payments','payments.invoice_id','=','invoices.invoice_no')
                              ->select('invoice_details.id as inDId','invoice_details.category_id as catID','invoice_details.product_id as proID','invoice_details.selling_qty as sQuan','invoice_details.unit_price as uPrice','invoice_details.selling_price as sPrice','payments.paid_amount as pAmount','payments.due_amount as dueAmount','payments.total_amount as tAmount','payments.discount_amount as disAmount')
                              ->where('invoices.invoice_no',$invoiceID)
                              ->get();

        $pdf = PDF::loadView('admin.pdf.creditCustomerDetailsPdf', $allData);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function paidCustomers(){
        $data = Payment::where('paid_status','paid')->get();
        return view('admin.customers.paid_customer',compact('data'));
    }

    public function paidCustomerPdf($invoiceID,$cusID){
        $allData['cutomerData'] = Customers::where('id',$cusID)->first();
        $allData['invoice_no'] = $invoiceID;
        $allData['details'] = DB::table('invoices') 
                              ->join('invoice_details','invoice_details.invoice_id','=','invoices.invoice_no')
                              ->join('payments','payments.invoice_id','=','invoices.invoice_no')
                              ->select('invoice_details.id as inDId','invoice_details.category_id as catID','invoice_details.product_id as proID','invoice_details.selling_qty as sQuan','invoice_details.unit_price as uPrice','invoice_details.selling_price as sPrice','payments.paid_amount as pAmount','payments.due_amount as dueAmount','payments.total_amount as tAmount','payments.discount_amount as disAmount')
                              ->where('invoices.invoice_no',$invoiceID)
                              ->get();

        $pdf = PDF::loadView('admin.pdf.paidCustomerDetailsPdf', $allData);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
