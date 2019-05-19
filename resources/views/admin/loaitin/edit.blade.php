@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại tin
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    {{-- Thong bao loi --}}
                    @if(count($errors)>0)
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}<br>
                            </div>
                        @endforeach
                    @endif
                    @if(Session('thongbao'))
                        <div class="alert alert-success">
                            {{Session('thongbao')}}
                        </div>
                    @endif
                    {{--#thong bao loi--}}
                    <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">                        
                        <div class="form-group">
                            <label>Tên loại tin</label>
                            <input class="form-control" name="Ten" value="{{$loaitin->Ten}}" placeholder="Please Enter Category Name" />
                        </div>                        
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select name="idTheLoai" class="form-control" id="">
                                @foreach($cactheloai as $tl)
                                    <option 
                                    @if($loaitin->idTheLoai == $tl->id)
                                        selected
                                    @endif
                                    value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <button type="submit" class="btn btn-default">Edit</button>
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