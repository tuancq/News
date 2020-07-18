@extends('admin.layout.index') 

@section('content') 
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tài Khoản
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                      @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach                           
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                         <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="form-group">
                                <label>Họ Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập Tên Người Dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập Địa Chỉ Email" />
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" name="passwordagain" placeholder="Nhập Lại Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Quyền Người Dùng</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
