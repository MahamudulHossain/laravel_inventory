<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\Units;
use Illuminate\Support\Facades\DB;
use PDF;

class StockController extends Controller
{
    public function viewStock(){
    	$query = DB::table('products');
        $query = $query->leftJoin('suppliers','suppliers.id' ,'=','products.supplier_id');
        $query = $query->leftJoin('categories','categories.id' ,'=','products.category_id');
        $query = $query->leftJoin('units','units.id' ,'=','products.unit_id');
        $query = $query->select('products.*','suppliers.name as sname','categories.name as catname','units.name as uname');
        $query = $query->orderBy('products.id','DESC');
        $query = $query->get();
        $result['data'] =  $query;
        return view('admin.stock.stock_report',$result);
    }

    public function downloadStockReport(){
    	$result['data'] = DB::table('products')
         		->leftJoin('suppliers','suppliers.id' ,'=','products.supplier_id')
         		->leftJoin('categories','categories.id' ,'=','products.category_id')
         		->leftJoin('units','units.id' ,'=','products.unit_id')
         		->select('products.*','suppliers.name as sname','categories.name as catname','units.name as uname')
        		->orderBy('products.id','DESC')
        		->get();
    	$pdf = PDF::loadView('admin.pdf.stockReportPdf', $result);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
