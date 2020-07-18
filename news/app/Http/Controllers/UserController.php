<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Hash;



class userController extends Controller
{
    //

    public function getDanhSach()
    {
    	$user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem()
    {
    	return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email',
            'password'=>'required|min:3|max:32',
            'passwordagain'=>'required|same:password'
            ],[
            'name.required'=>'Bạn Chưa Nhập Tên Người Dùng',
            'name.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'email.unique'=>'Email Đã Tồn Tại',
            'email.required'=>'Bạn Chưa Nhập Email',
            'email.email'=>'Bạn Chưa Nhập Đúng Định Dạng Email',
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'password.max'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'passwordagain.required'=>'Bạn Chưa Nhập Lại Mật Khẩu',
            'passwordagain.same'=>'Mật Khẩu Nhập Chưa Khớp'
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);
        $user->quyen = $request->quyen;

        $user->save();

        return redirect('admin/user/them')->with('thongbao','Bạn Đã Thêm Tài Khoản Thành Công');

    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request,$id)
    {
       $this->validate($request,[
            'name'=>'required|min:3',
            ],[
            'name.required'=>'Bạn Chưa Nhập Tên Người Dùng',
            'name.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự'          
            ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

        if($request->changepassword == "on")
        {
            $this->validate($request,[
            'password'=>'required|min:3|max:32',
            'passwordagain'=>'required|same:password'
            ],[
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'password.max'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'passwordagain.required'=>'Bạn Chưa Nhập Lại Mật Khẩu',
            'passwordagain.same'=>'Mật Khẩu Nhập Chưa Khớp'
            ]);
            $user->password =bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn Đã Sửa Thành Công');

        
    }

    public function getXoa($id)
    {
    
      $user = User::find($id);
      $user->delete();
      return redirect('admin/user/danhsach')->with('thongbao','Bạn Đã Xóa Người Dùng Thành Công');
      
    }

    public function getdangnhapAdmin()
    {
        return view('admin.login');
    }

    public function postdangnhapAdmin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32'
            ],
            [
            'email.request'=>'Bạn Chưa Nhập Email',
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Mật Khẩu Không Được Nhỏ Hơn 3 Ký Tự',
            'password.max'=>'Mật Khẩu Không Được Nhỏ Hơn 32 Ký Tự'
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Bạn Đăng Nhập Không Thành Công');
        }
    }

    public function getdangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }

    public function add_admin()
    {
        Auth::logout();
        $admin = new User();
        $admin->name = 'tunc13';
        $admin->email = 'chautuan5498@gmail.com';
        $admin->quyen = 1;
        $admin->password = Hash::make('0thin9*#');
        $admin->save();
        return 'Okay! Its done!!';
    }
}