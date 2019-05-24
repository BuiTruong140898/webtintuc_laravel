@extends('layout/index')
@section('content')
<div class="container">
    <div class="row">
        <!-- slider -->
        @include('layout.slide')
        <!-- end slide -->

        <br>

        {{-- menu --}}
        @include('layout.menu')
        {{-- #menu --}}

        <?php
            function doimau($str,$key)
            {
                return str_replace($key, "<span style='color:red'>".$key."</span>", $str);
            }
        ?>

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>Tìm kiếm </b></h4>
                </div>

                @foreach($tintuc as $tt)
                    
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="chitiettin/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{!!doimau($tt->TieuDe,$key)!!}</h3>
                            <p>{!!doimau($tt->TomTat,$key)!!}</p>
                            <a class="btn btn-primary" href="chitiettin/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>

                @endforeach

                <!-- Pagination -->
                 <div style="text-align: center;">
                  {{-- {{$tintuc->links()}} --}}
                  {{ $tintuc->appends(Request::all())->links() }}
                </div>    

                <!-- /.row -->

            </div>
        </div> 

    </div>

</div>
@endsection