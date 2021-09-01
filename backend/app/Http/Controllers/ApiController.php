<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    //
    public function preview(Request $request){
        $text = $request->input('text');
        // $a = 'Hello _Parsedown_!';
        $Parsedown = new \Parsedown();
        $a = $Parsedown->text($text);


        return response()->json(['html' => $a]);
    }
}
