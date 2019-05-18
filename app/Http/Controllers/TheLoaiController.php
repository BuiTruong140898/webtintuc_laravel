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

    public function getThem(){
    	return view('admin.theloai.add');

    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten' => 'required|min:3|max:100'
        ],[
            'Ten.required' => "Ban chua nhap ten the loai",
            'Ten.min' => "Ten qua ngan, vui long nhap toi thieu 3 ki tu",
            'Ten.max' => 'Ten qua dai, vui long nhap toi da 100 ki tu'
        ]);
        $theloai = new TheLoai;
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Them thanh cong');
    }
}

