<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list',compact('loaitin'));
    }

    public function getThem(){
    	return view('admin.loaitin.add');

    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten' => 'required|min:3|max:100|unique:LoaiTin,Ten'
        ],[
            'Ten.required' => "Ban chua nhap ten the loai",
            'Ten.unique' => 'The loai da ton tai',            
            'Ten.min' => "Ten qua ngan, vui long nhap toi thieu 3 ki tu",
            'Ten.max' => 'Ten qua dai, vui long nhap toi da 100 ki tu'
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Them thanh cong');
    }

    public function getSua($id){
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit',compact('loaitin'));
    }

    public function postSua(Request $req, $id){
        $loaitin = LoaiTin::find($id);
        $this->validate($req,
            [ 
                'Ten' => 'required|min:3|max:100|unique:LoaiTin,Ten'
            ],
            [
                'Ten.required' => 'Vui long nhap ten vao',
                'Ten.unique' => 'The loai da ton tai',
                'Ten.min' => "Ten qua ngan, vui long nhap toi thieu 3 ki tu",
                'Ten.max' => 'Ten qua dai, vui long nhap toi da 100 ki tu'

            ]
        );
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Ban da xoa mot truong thanh cong');
    }
}

