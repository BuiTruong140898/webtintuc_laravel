<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;

use App\TheLoai;

class TinTucController extends Controller
{
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.list',compact('tintuc'));
    }

    public function getThem(){

    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten'
        ],[
            'Ten.required' => "Ban chua nhap ten the loai",
            'Ten.unique' => 'The loai da ton tai',            
            'Ten.min' => "Ten qua ngan, vui long nhap toi thieu 3 ki tu",
            'Ten.max' => 'Ten qua dai, vui long nhap toi da 100 ki tu'
        ]);
        $theloai = new TheLoai;
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Them thanh cong');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.edit',compact('theloai'));
    }

    public function postSua(Request $req, $id){
        $theloai = TheLoai::find($id);
        $this->validate($req,
            [ 
                'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten'
            ],
            [
                'Ten.required' => 'Vui long nhap ten vao',
                'Ten.unique' => 'The loai da ton tai',
                'Ten.min' => "Ten qua ngan, vui long nhap toi thieu 3 ki tu",
                'Ten.max' => 'Ten qua dai, vui long nhap toi da 100 ki tu'

            ]
        );
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Ban da xoa mot truong thanh cong');
    }
}

