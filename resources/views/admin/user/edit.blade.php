@extends('admin/layout/index')
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
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
                    <form action="admin/user/sua/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="name" value="{{$user->name}}" placeholder="Please Enter Username" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" readonly class="form-control" name="email" value="{{$user->email}}" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Change password</label>
                            <input type="checkbox" id="changePassword" name="changePassword">                            
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" disabled="" class="form-control password" name="password" value="" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>RePassword</label>
                            <input type="password" disabled="" class="form-control password" name="repassword" placeholder="Please Enter RePassword" />
                        </div>
                        <div class="form-group">
                            <label>User Level</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" 
                                @if($user->quyen == 1)
                                checked=""
                                @endif
                                type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0"
                                @if($user->quyen == 0)
                                checked=""
                                @endif
                                type="radio">Member
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">User edit</button>
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#changePassword').change(function(){
                if($(this).is(':checked')){
                    $('.password').removeAttr('disabled');
                }
                else{
                    $('.password').attr('disabled','');
                }
            })
        })
    </script>
@endsection