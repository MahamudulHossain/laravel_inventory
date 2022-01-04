<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Categories::all();

        return view('admin.categories.categories_list',compact('data'));
    }

    public function add_categories(Request $req){
        $supp = new Categories;
        $supp->name = $req->post('name');
        $supp->created_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Category Added Successfully');
        return redirect('/view_categories');
    }

    public function delete(Request $req,$id){
       $result = Categories::find($id);
       $result->delete();
       $req->session()->flash('message','Category Deleted Successfully');
       return redirect('/view_categories');
    }
    
}
