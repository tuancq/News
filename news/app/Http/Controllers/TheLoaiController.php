<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
class TheLoaiController extends Controller
{
    //

    public function getDanhSach()
    {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

      public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten'
    		],
    		[
    			'Ten.required'=>'Bạn Chưa Nhập Tên Thể Loại',
    			'Ten.min'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Cho Đến 100 Ký Tự',
    			'Ten.max'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Cho Đến 100 Ký Tự',
                'Ten.unique'=>'Tên Thể Loại Đã Tồn Tại'
    		]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	
    	return redirect('admin/theloai/them')->with('thongbao','Bạn Đã Thêm Thành Công');

    }

    public function getSua($id)
    {
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten' => '
                    required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' =>'Bạn Chưa Nhập Tên Thể Loại',
                'Ten.unique'=>'Tên Thể Loại Đã Tồn Tại',
                'Ten.min'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Cho Đến 100 Ký Tự',
                'Ten.max'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Cho Đến 100 Ký Tự'
            ]
            );
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Bạn Đã Sửa Thành Công');
    }

    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn Đã Xóa Thành Công');
    }
}
