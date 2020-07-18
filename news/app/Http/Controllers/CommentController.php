<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
use App\TinTuc;

class CommentController extends Controller
{
    //

    public function getXoa($id,$idTinTuc)
    {
        
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Bạn Đã Xóa Bình Luận Thành Công');
        
    }

    public function postComment($id,Request $request)
    {
    	$idTinTuc = $id;
    	$comment = new Comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();
    	$tintuc = TinTuc::find($id);
    	return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Bạn Viết Bình Luận Thành Công');
    }
}