<?php
use Illuminate\Support\Facades\DB;


	function getUnitId($proID){
		$query = DB::table('products')
				 ->select('unit_id as uid')
				 ->where('id',$proID)	
				 ->get();
		$unitlist = $query->toArray();		 
		return $unitlist;
	}

	function getUnitName($uid){
		$qr = DB::table('units')
			  ->select('name')	
			  ->where('id',$uid)
			  ->get();
		$unitName = $qr->toArray();		 
		return $unitName;	  
	}