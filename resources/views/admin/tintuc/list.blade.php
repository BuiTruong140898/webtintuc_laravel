 @extends('admin.layout.index')
 @section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                {{-- Thong bao xoa --}}
                    @if(Session('thongbao'))
                        <div class="alert alert-success">
                            {{Session('thongbao')}}
                        </div>
                    @endif
                {{-- #Thong bao xoa --}}
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Loại tin</th>
                            <th>Số lượt xem</th>
                            <th>Nổi bật</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc as $tintuc)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tintuc->id}}</td>
                            <td>{{$tintuc->TieuDe}}<br>
                                <img src="upload/tintuc/{{$tintuc->Hinh}}" height="100px" weight="100px" alt="">
                            </td>
                            <td>{{$tintuc->TomTat}}</td>
                            <td>{{$tintuc->loaitin->theloai->Ten}}</td>
                            <td>{{$tintuc->loaitin->Ten}}</td>
                            <td>{{$tintuc->SoLuotXem}}</td>
                            <td>
                                @if($tintuc->NoiBat)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tintuc->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tintuc->id}}">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection