@extends('admin.layout.index')
@section('content')
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>Add</small>
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
                        <form action="admin/theloai/them" method="POST">

                            <input type="hidden" name="_token" value="{{csrf_token()}}">                      
                            
                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <input class="form-control" name="Ten" placeholder="Please Enter Category Name" />
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
