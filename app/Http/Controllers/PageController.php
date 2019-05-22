<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

use App\LoaiTin;

use App\Slide;

use App\TinTuc;


class PageController extends Controller
{
	function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('slide',$slide);
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

    function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('page.loaitin',compact('loaitin','tintuc'));
    }

    function chitiettin($id)
    {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat','1')->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('page.chitiettin',compact('tintuc','tinnoibat','tinlienquan'));
    }
}
