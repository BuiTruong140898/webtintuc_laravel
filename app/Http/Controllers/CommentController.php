<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Comment;

use App\TinTuc;

class CommentController extends Controller
{
   public function getxoa($id, $idTinTuc){
	   	$comment = Comment::find($id);
	   	$comment->delete();

	   	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Da xoa mot binh luan');
   }

    public function postComment($id, Request $req)
    {
        $tintuc = TinTuc::find($id);
        $comment = new Comment;
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $req->NoiDung;
        $comment->save();

        return redirect("chitiettin/$id/".$tintuc->TieuDeKhongDau.'.html')->with('thongbao','Da luu comment thanh cong');
        
    }
}
