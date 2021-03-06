<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//use App\Http\Request;

use App\User;

use App\Comment;

class UserController extends Controller
{
    public function getDangNhap(){
        return view('page.dangnhap');
    }

    public function postDangNhap(Request $req){
        $this->validate($req,[
            'email' => 'required|email',
            'password' => 'required|min:6|max:32'
        ],[
            'email.email' => 'Vui long nhap dung dinh dang mail',
            'email.required' => 'Vui long nhap email',
            'password.required' => 'Vui Long nhap mat khau',
            'password.min' => "vui long dien mat khau toi thieu 3 ki tu, toi da 32 ki tu",
            'password.max' => "vui long dien mat khau toi thieu 3 ki tu, toi da 32 ki tu",
        ]);

        if(Auth::attempt([
            'email' => $req->email,
             'password' => $req->password
        ]))
        {
            return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao','Dang nhap khong thanh cong');
        }

    }

    public function dangxuat(){
        Auth()->logout();
        return view('page.dangnhap');
    }

    public function getDangNhapAdmin(){
    	return view('admin.login');
    }

    public function postDangNhapAdmin(Request $req){
    	$this->validate($req,[
    		'email'=>'required',
    		'password'=>'required|min:6|max:32'
    	],[
    		'email.required'=>'Vui long nhap email',
    		'password.requieres'=>'Vui long nhap mat khau',
    		'password.min'=>'Mat khau qua ngan, vui long nhap toi thieu 6 ki tu',
    		'password.max'=>'Mat khau qua dai, vui long nhap toi da 32 ki tu'
    	]);

    	if(auth::attempt([
            'email'=>$req->email,
            'password'=>$req->password
        ]))
    	{
    		return redirect('admin/theloai/danhsach');
	  	}
	  	else
	  	{
	  		return redirect('admin/dang-nhap')->with('thongbao','Vui Long dang nhap lai');
	  	}
    }

    public function getDangXuatAdmin(){
    	Auth::logout();
    	return redirect('admin/dang-nhap');
    }
    
    
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.list',compact('user'));
    }

    public function getThem(){
        return view('admin.user.add');
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'name'=>'required|min:3',
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

    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    public function postSua(Request $req,$id){
        $this->validate($req,[
            'name'=>'required|min:3',
        ],[
            'name.required'=>'Vui long nhap ten',
            'name.min'=>'Ten nguoi dung phai co it nhat 3 ki tu',
        ]);

        $user = User::find($id);
        $user->name = $req->name;
        $user->quyen = $req->quyen;

        if($req->changePassword == 'on'){
            $this->validate($req,[
            'password'=>'required|min:6|max:32',
            'repassword'=>'required|same:password',
        ],[
            'password.required'=>'Vui long nhap mat khau',
            'password.min'=>'Vui long nhap mat khau toi thieu 6 ki tu',
            'password.max'=>'Vui long nhap password toi da 32 ki tu',
            'repassword.required'=>'Vui long nhap xac nhan mat khau',
            'repassword.same'=>'Mat khau xac nhan chua khop'   
        ]);
             $user->password = bcrypt($req->password);
        }

        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao','Sua user thanh cong');
    }

    public function getXoa($id){
        $user = User::find($id);
        //Xoa het cac comment truoc khi xoa user
        foreach($user->comment as $comment)
        {
            $comment->delete();
        }
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xoa mot user thanh cong');
    }

    public function getThongTinNguoiDung(){
        return  view('page.thongtin_nguoidung');
    } 

    public function postThongTinNguoiDung(Request $req){
        $this->validate($req,[
            'name'=>'required|min:3',
            
        ],[
            'name.required'=>'Vui long nhap ten',
            'name.min'=>'Ten nguoi dung phai co it nhat 3 ki tu',
        ]);

        $user = Auth::user();
        $user->name = $req->name;

        if($req->changepassword == "on"){
            $this->validate($req,[
                'password'=>'required|min:6|max:32',
                'repassword'=>'required|same:password',
            ],[
                'password.required'=>'Vui long nhap mat khau',
                'password.min'=>'Vui long nhap mat khau toi thieu 6 ki tu',
                'password.max'=>'Vui long nhap password toi da 32 ki tu',
                'repassword.required'=>'Vui long nhap xac nhan mat khau',
                'repassword.same'=>'Mat khau xac nhan chua khop'   
            ]);
            $user->password = bcrypt($req->password);
        }

        $user->save();

        return redirect('thongtinnguoidung')->with('thongbao','Da thay doi thong tin thanh cong');

    }

    public function getDangKy(){
        return view('page.dangky');
    }

    public function postDangKy(Request $req){
        $this->validate($req,[
            'name'=>'required|min:3',
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
        $user->quyen = 0;
        $user->save();

        return redirect('dangnhap')->with('thongbao','Ban da dang ky tai khoan thanh cong<br>Vui long dang nhap');
    
    }
}


