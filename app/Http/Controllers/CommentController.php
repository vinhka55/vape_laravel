<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function getTimeComment()
    {
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        if($time->day < 10){
            $day = '0'.$time->day;
        }
        else{
            $day = $time->day;
        }

        if($time->month < 10){
            $month = '0'.$time->month;
        }
        else{
            $month = $time->month;
        }

        if($time->hour < 10){
            $hour = '0'.$time->hour;
        }
        else{
            $hour = $time->hour;
        }

        if($time->minute < 10){
            $minute = '0'.$time->minute;
        }
        else{
            $minute = $time->minute;
        }
        return $day.'/'.$month.'/'.$time->year.' lúc '.$hour.':'.$minute;
    }
    public function add(Request $req)
    {
        $data = $req->all();
        $data["time"] = $this->getTimeComment();
        if($comment = Comment::create($data)){
            return response()->json([
                'data'=>$comment,
                'status'=>201,
                'message'=>'insert success'
            ]);
        }
    }
    public function show($idProduct)
    {
        $comment = Comment::where('product_id',$idProduct)->with('user')->get();
        return $comment;
    }
    public function delete($idComment)
    {
        $comment = Comment::find($idComment);
        $comment->delete();
    }
}
