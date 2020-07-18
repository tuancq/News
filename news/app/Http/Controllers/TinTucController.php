<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;

use App\Comment;
class TinTucController extends Controller
{
    //

    public function getDanhSach()
    {
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

      public function postThem(Request $request)
    {    
           
    	$this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
            ],[
            'LoaiTin.required'=>'Bạn Chưa Chọn Loại Tin',
            'TieuDe.required'=>'Bạn Chưa Nhập Tiêu Đề',
            'TieuDe.min'=>'Tiêu Đề Phải Có Ít Nhất 3 Ký Tự',
            'TieuDe.unique'=>'Tiêu Đề Đã Tồn Tại',
            'TomTat.required'=>'Bạn Chưa Nhập Tóm Tắt',
            'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung'
            ]);
            
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');          
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi != 'jpeg')
            {
                  return redirect('admin/tintuc/them')->with('loi','Bạn Chỉ Được Chọn File Có Đuôi jpg,png,jpeg');
            }
            
            $name = $file->getClientOriginalName();
            $Hinh =  str_random(4)."_". $name;
            //echo $Hinh;
            
            while (file_exists("upload/tintuc/".$Hinh)) 
            {
                $Hinh = str_random(4)."_". $name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
            
        }
        else
        {
            $tintuc->Hinh = "";
        }
        
        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao','Bạn Đã Thêm Tin Tức Thành Công');     

    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request,$id)
    {
       $tintuc = TinTuc::find($id);
       $this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
            ],[
            'LoaiTin.required'=>'Bạn Chưa Chọn Loại Tin',
            'TieuDe.required'=>'Bạn Chưa Nhập Tiêu Đề',
            'TieuDe.min'=>'Tiêu Đề Phải Có Ít Nhất 3 Ký Tự',
            'TieuDe.unique'=>'Tiêu Đề Đã Tồn Tại',
            'TomTat.required'=>'Bạn Chưa Nhập Tóm Tắt',
            'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung'
        ]);
        //$tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');          
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi != 'jpeg')
            {
                  return redirect('admin/tintuc/them')->with('loi','Bạn Chỉ Được Chọn File Có Đuôi jpg,png,jpeg');
            }
            
            $name = $file->getClientOriginalName();
            $Hinh =  str_random(4)."_". $name;
            
            while (file_exists("upload/tintuc/".$Hinh)) 
            {
                $Hinh = str_random(4)."_". $name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
            
        }        
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn Đã Sửa Thành Công');

    }

    public function getXoa($id)
    {
       $tintuc = TinTuc::find($id);
       $tintuc->delete();
       return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn Đã Xóa Thành Công');
    }
}
