<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dang-nhap','UserController@getDangNhapAdmin');
Route::post('admin/dang-nhap','UserController@postDangNhapAdmin');
Route::get('admin/dang-xuat','UserController@getDangXuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function(){
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua');
		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');
		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','LoaiTinController@getDanhSach');
		Route::get('sua/{id}','LoaiTinController@getSua');
		Route::post('sua/{id}','LoaiTinController@postSua');
		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');
		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','TinTucController@getDanhSach');
		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');
		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');
		Route::get('xoa/{id}','TinTucController@getXoa');
	});

	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','UserController@getDanhSach');
		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');
		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');
		Route::get('xoa/{id}','UserController@getXoa');
	});

	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idtheloai}','AjaxController@getLoaiTin');
	});

	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}/{idTinTuc}','CommentController@getxoa');
	});

});

Route::get('trangchu','PageController@trangchu');
Route::get('lienhe','PageController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('chitiettin/{id}/{TenKhongDau}.html','PageController@chitiettin');

Route::get('dangnhap','UserController@getDangNhap');
Route::post('dangnhap','UserController@postDangNhap');
Route::get('dangxuat','UserController@dangxuat');

Route::post('comment/{id}','CommentController@postComment');
Route::get('thongtinnguoidung','UserController@getThongTinNguoiDung');
Route::post('thongtinnguoidung','UserController@postThongTinNguoiDung');

Route::post('timkiem','PageController@timkiem');

Route::get('dangky','UserController@getDangKy');
Route::post('dangky','UserController@postDangKy');