@extends('layout.index')
@section('content')
<!-- Page Content -->
    <div class="container">

    	
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
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
				    	<form action="dangnhap" method="POST">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        
    </div>
<!-- end Page Content -->
@endsection