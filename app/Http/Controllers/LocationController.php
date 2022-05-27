<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LocationController extends Controller
{
    public function choose_address(Request $request)
    {
        $district = DB::table('devvn_quanhuyen')->where('matp',$request->matp)->get();
        $output='';
        foreach ($district as $key => $value) {
            $output .= '<option class="item-district" value="'.$value->maqh.'">'.$value->name.'</option>';
        }
        return $output;
    }
    public function choose_ward(Request $request)
    {
        $ward = DB::table('devvn_xaphuongthitran')->where('maqh',$request->maqh)->get();
        $output='';
        foreach ($ward as $key => $value) {
            $output .= '<option class="item-ward" value="'.$value->xaid.'">'.$value->name.'</option>';
        }
        return $output;
    }
}
