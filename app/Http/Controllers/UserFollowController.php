<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    //ユーザーをフォローできるように
    public function store(Request $request, $id)
    {
        \Auth::user()->follow($id);
        return back();
    }
    
    //ユーザーをアンフォローできるように
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }    
}
