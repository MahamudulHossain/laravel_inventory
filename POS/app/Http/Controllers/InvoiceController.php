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

class InvoiceController extends Controller
{
    public function show()
    {
        $allData = Invoice::get();
        return view('admin.invoice.invoice_list',compact('allData'));
    }

}
