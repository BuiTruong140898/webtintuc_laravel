<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.list',compact('theloai'));
    }
}

