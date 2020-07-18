<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //

    public function getDanhSach()
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten' => 'required|min:1|max:100|unique:LoaiTin,Ten',
    			'TheLoai'=>'required'
    		],
    		[
    			'Ten.required'=>'Bạn Chưa Nhập Tên Loại Tin',
    			'Ten.min'=>'Tên Loại Tin Phải Có Độ Dài Từ 1 Cho Đến 100 Ký Tự',
    			'Ten.max'=>'Tên Loại Tin Phải Có Độ Dài Từ 1 Cho Đến 100 Ký Tự',
                'Ten.unique'=>'Tên Loại Tin Đã Tồn Tại',
                'TheLoai.required'=>'Bạn Chưa Chọn Thể Loại'
    		]);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();
    	
    	return redirect('admin/loaitin/them')->with('thongbao',' Bạn Đã Thêm Thành Công');

    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id)
    {
        
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:1|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Ten.required'=>'Bạn Chưa Nhập Tên Loại Tin',
                'Ten.min'=>'Tên Loại Tin Phải Có Độ Dài Từ 1 Cho Đến 100 Ký Tự',
                'Ten.max'=>'Tên Loại Tin Phải Có Độ Dài Từ 1 Cho Đến 100 Ký Tự',
                'Ten.unique'=>'Tên Loại Tin Đã Tồn Tại',
                'TheLoai.required'=>'Bạn Chưa Chọn Thể Loại'
            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn Đã Sửa Thành Công');
        
    }

    public function getXoa($id)
    {
        
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn Đã Xóa Thành Công');
        
    }
}