<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;

use App\TheLoai;

use App\LoaiTin;

class TinTucController extends Controller
{
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.list',compact('tintuc'));
    }

    public function getThem(){
        $cactheloai = TheLoai::all();
        $cacloaitin = LoaiTin::all();
        return view('admin/tintuc/add',compact('cacloaitin','cactheloai'));
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required',
        ],[
            'LoaiTin.required'=>'Vui long chon loai tin',
            'TieuDe.required'=>'Vui Long nhap tieu de',
            'TieuDe.min'=>'Tieu de ban nhap qua ngan, vui long nhap toi thieu 3 ki tu',
            'TieuDe.unique'=>'Tieu de da ton tai',
            'TomTat.required'=>'Ban chua nhap tom tat',
            'NoiDung.required'=>'Ban chua nhap noi dung'
        ]);

        $tintuc = new TinTuc;
        $tintuc->idLoaiTin = $req->LoaiTin;
        $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
        $tintuc->TomTat = $req->TomTat;
        $tintuc->NoiDung = $req->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($req->hasFile('Hinh')){
            $file = $req->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi','Vui long them file .jpg, .png, .jpeg');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4).'_'.$name;
            while(file_exists('upload/tintuc/'.$hinh)){
                $hinh = str_ramdom(4).'_'.$name;
            }
            $file->move('upload/tintuc',$hinh);
            $tintuc->Hinh = $hinh;
        }
        else{
            $tintuc->Hinh = "";

        }

        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Them thanh cong');
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

