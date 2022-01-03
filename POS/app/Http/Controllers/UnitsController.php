<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Units::all();

        return view('admin.units.units_list',compact('data'));
    }

    public function add_unit(Request $req){
        $supp = new Units;
        $supp->name = $req->post('name');
        $supp->created_by = $req->session()->get('ADMIN_ID');
        $supp->save();
        $req->session()->flash('message','Unit Added Successfully');
        return redirect('/view_units');
    }

    public function delete(Request $req,$id){
       $result = Units::find($id);
       $result->delete();
       $req->session()->flash('message','Unit Deleted Successfully');
       return redirect('/view_units');
    }
}
