@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    {{-- Thong bao loi --}}
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(Session('thongbao'))
                        <div class="alert alert-success">
                            {{Session('thongbao')}}
                        </div>
                    @endif
                    {{-- #thong bao loi --}}
                    <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($cactheloai as $tl)
                                        <option
                                        @if($tintuc->loaitin->theloai->id == $tl->id)
                                            selected
                                        @endif 
                                        value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loai tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($cacloaitin as $lt)
                                        <option
                                        @if($tintuc->loaitin->id == $lt->id)
                                            selected
                                        @endif 
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="TomTat" class="form-control ckeditor" name="TomTat"  placeholder="Please Enter Category Order">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                               <textarea id="NoiDung" class="form-control ckeditor" name="NoiDung" placeholder="Please Enter Category Order">{{$tintuc->NoiDung}} </textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <br>
                                <img src="upload/tintuc/{{$tintuc->Hinh}}">
                                <input class="form-control" type="file" name="Hinh">
                            </div>

                            @if(Session('loi'))
                                <div class="alert alert-danger">
                                    {{Session('loi')}}
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Nổi bật</label>
                                
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if($tintuc->NoiBat == 1) 
                                        checked=""
                                    @endif
                                    type="radio">Có
                                </label>
                                
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0"
                                    @if($tintuc->NoiBat == 0)
                                        checked
                                    @endif
                                    type="radio">Không
                                </label>
    
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection