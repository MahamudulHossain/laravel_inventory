<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.login');
// });

Route::get('/',[AdminController::class,'index']);
Route::post('adminLogin',[AdminController::class,'adminLoginProcess']);

Route::group(['middleware'=>'admin_auth'],function () {
  Route::get('logout', function(){
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    return redirect('/');
  });
Route::get('/dashboard',[AdminController::class,'dashboard']);
//Suppliers CRUD
Route::get('/view_suppliers',[SuppliersController::class,'show']);
Route::get('/add_suppliers_form',[SuppliersController::class,'add_form']);
Route::post('addSupplier',[SuppliersController::class,'add_supplier']);
Route::get('/delSupplier/{id}',[SuppliersController::class,'delete']);
Route::get('/editSupplier/{id}',[SuppliersController::class,'edit_form']);
Route::post('updateSupplier/{id}',[SuppliersController::class,'update_supplier']);
//Customers CRUD
Route::get('/view_customers',[CustomersController::class,'show']);
Route::get('/add_customers_form',[CustomersController::class,'add_form']);
Route::post('addCustomer',[CustomersController::class,'add_customer']);
Route::get('/delCustomer/{id}',[CustomersController::class,'delete']);
Route::get('/editCustomer/{id}',[CustomersController::class,'edit_form']);
Route::post('updateCustomer/{id}',[CustomersController::class,'update_customer']);
//Units
Route::get('/view_units',[UnitsController::class,'show']);
Route::post('addUnit',[UnitsController::class,'add_unit']);
Route::get('/delUnit/{id}',[UnitsController::class,'delete']);
//Categories
Route::get('/view_categories',[CategoriesController::class,'show']);
Route::post('addCategories',[CategoriesController::class,'add_categories']);
Route::get('/delCategories/{id}',[CategoriesController::class,'delete']);
//Products CRUD
Route::get('/view_products',[ProductsController::class,'show']);
Route::get('/add_products_form',[ProductsController::class,'add_form']);
Route::post('addProduct',[ProductsController::class,'add_product']);
Route::get('/delProduct/{id}',[ProductsController::class,'delete']);
Route::get('/editProduct/{id}',[ProductsController::class,'edit_form']);
Route::post('updateProduct/{id}',[ProductsController::class,'update_product']);

//Purchase
Route::get('/view_purchase',[PurchaseController::class,'show']);
Route::get('/purchase_form',[PurchaseController::class,'add_form']);
Route::post('purchase_now',[PurchaseController::class,'purchase_now']);
Route::get('get-category',[AjaxController::class,'getCategory']);
Route::get('get-product',[AjaxController::class,'getProduct']);
Route::get('/delPurchase/{id}',[PurchaseController::class,'delete']);
Route::get('updateStatus/{id}',[PurchaseController::class,'update_status']);

//Invoice
Route::get('/view_invoice',[InvoiceController::class,'show']);
Route::get('/approve_invoice',[InvoiceController::class,'approveInvoiceView']);
Route::get('/approveInvoiceForm/{id}',[InvoiceController::class,'approveInvoiceForm']);
Route::post('storeApproveInvoice/{id}',[InvoiceController::class,'storeApproveInvoice']);
Route::get('/invoice_form',[InvoiceController::class,'add_form']);
Route::get('get-stoke',[AjaxController::class,'getStoke']);
Route::post('store_invoice',[InvoiceController::class,'invoiceStore']);
Route::get('/delInvoice/{id}',[InvoiceController::class,'delete']);
Route::get('/printInvoice/{id}',[InvoiceController::class,'generate_pdf']);
Route::get('/report_invoice',[InvoiceController::class,'generate_invoice_report']);
Route::get('/invoiceReportPdf',[InvoiceController::class,'generate_invoice_report_pdf']);

//Stocks
Route::get('/view_stock',[StockController::class,'viewStock']);
Route::get('/download-stock-report',[StockController::class,'downloadStockReport']);



});