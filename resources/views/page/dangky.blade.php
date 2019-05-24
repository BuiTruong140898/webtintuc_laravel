@extends('layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container">

    	
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
				  	<div class="panel-body">
                        {{-- Thong bao --}}
                        @if(count($errors))
                            @foreach($errors->all() as $err)
                                <div class="alert alert-danger">
                                {{$err}} <br>
                                </div>
                            @endforeach
                        @endif
                        @if(Session('thongbao'))
                            <div class="alert alert-danger">{{Session('thongbao')}}</div>
                        @endif
                        {{-- #thong bao --}}
				    	<form action="dangky" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
							  	>
							</div>
							<br>	
							<div>
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="repassword" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng ký
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            
        </div>
        
    </div>
    <!-- end Page Content -->
@endsection