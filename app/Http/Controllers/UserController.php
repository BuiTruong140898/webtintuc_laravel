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

    public function getThem(){
        return view('admin.user.add');
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:32',
            'repassword'=>'required|same:password',
        ],[
            'name.required'=>'Vui long nhap ten',
            'name.min'=>'Ten nguoi dung phai co it nhat 3 ki tu',
            'email.requires'=>'Vui lonh nhap email',
            'email.email'=>'Vui long nhap email dung dinh dang',
            'email.unique'=>'Email da ton tai',
            'password.required'=>'Vui long nhap mat khau',
            'password.min'=>'Vui long nhap mat khau toi thieu 6 ki tu',
            'password.max'=>'Vui long nhap password toi da 32 ki tu',
            'repassword.required'=>'Vui long nhap xac nhan mat khau',
            'repassword.same'=>'Mat khau xac nhan chua khop'   
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->quyen = $req->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao','Them user thanh cong');

    }
}
