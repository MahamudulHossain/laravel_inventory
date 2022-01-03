<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuppliersController;

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


});