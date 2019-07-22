<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    //記事のお気に入り登録
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id); //ログインユーザーが記事をお気に入りに追加
        return back();
    }
    //お気に入り解除
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return back();
    }
}
