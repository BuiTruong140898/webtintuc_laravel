<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//use App\Http\Request;

use App\User;

class UserController extends Controller
{
    // public function getDangNhapAdmin(){
    // 	return view('admin.login');
    // }

    // public function postDangNhapAdmin(Request $req){
    // 	$this->validate($req,[
    // 		'email'->'required',
    // 		'password'->'required|min:6|max:32'
    // 	],[
    // 		'email.required'->'Vui long nhap email',
    // 		'password.requieres'->'Vui long nhap mat khau',
    // 		'password.min'->'Mat khau qua ngan, vui long nhap toi thieu 6 ki tu',
    // 		'password.max'->'Mat khau qua dai, vui long nhap toi da 32 ki tu'
    // 	]);

    // 	if(auth::attempt(['email'=>$req->email,'password'=>$req->password]))
    // 	{
    // 		return redirect('admin/theloai/danhsach');
	  	// }
	  	// else
	  	// {
	  	// 	return redirect('admin/dang-nhap')->with('thongbao','Vui Long dang nhap lai');
	  	// }
    // }

    // public function getDangXuatAmin(){
    // 	Auth::logout();
    // 	return rediredt('admin/dang-nhap');
    // }
    // 
    
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.list',compact('user'));
    }
}
