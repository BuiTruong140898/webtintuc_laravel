<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;

use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list',compact('loaitin'));
    }

    public function getThem(){
        $cactheloai = TheLoai::all();
    	return view('admin.loaitin.add',compact('cactheloai'));

    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
            'idTheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Vui long nhap ten loai tin',
            'Ten.unique'=>'Ten loai tin da ton tai',
            'Ten.min'=>'Ten qua ngan, vui long nhap toi thieu 3 ki tu',
            'Ten.max'=>'Ten qua dai, vui long nhap toi da 100 ki tu',
            'idTheloai.required'=>'Vui long chon the loai'
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Da them thanh cong');
    }
    public function getSua($id){
        $cactheloai = TheLoai::all();        
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit',compact('loaitin','cactheloai'));
    }

    public function postSua(Request $req, $id){
       $this->validate($req,[
            'Ten'=>'required|unique:LoaiTin,Ten,idTheLoai|min:3|max:100',
            'idTheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Vui long nhap ten loai tin',
            'Ten.unique'=>'Ten loai tin da ton tai',
            'Ten.min'=>'Ten qua ngan, vui long nhap toi thieu 3 ki tu',
            'Ten.max'=>'Ten qua dai, vui long nhap toi da 100 ki tu',
            'idTheloai.required'=>'Vui long chon the loai'
        ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Da sua thanh cong');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Ban da xoa mot truong thanh cong');
    }
}

