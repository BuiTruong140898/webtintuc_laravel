<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

use App\LoaiTin;

class PageController extends Controller
{
	function __construct(){
		$theloai = TheLoai::all();
		view()->share('theloai',$theloai);
	}


    function trangchu()
    {
    	return view('page.trangchu');
    }

    function lienhe()
    {
    	return view('page.lienhe');
    }
}
