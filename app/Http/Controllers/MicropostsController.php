<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost;

class MicropostsController extends Controller
{
    public function index()
        {
            $data = [];
            if (\Auth::check()) {
                $user = \Auth::user();
                $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(5);
                
                $data = [
                    'user' => $user,
                    'microposts' => $microposts,
                ];
            }
            
            return view('welcome', $data);
        }
        
    public function create()
    {
        $micropost = new Micropost;
        
        return view('microposts.create', ['micropost' => $micropost]);
    }
    
    public function show($id)
    {
        $micropost = Micropost::find($id);
        
        return view('users.show', ['micropost' => $micropost]);
    }
        
    public function store(Request $request)
    { //validateは適切なバリデーション処理を行う。validatesRequestsトレイトも継承
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);
 //create メソッドを使って Micropost を保存
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

        return back();
    }    
    
    // getでmicroposts/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $micropost = Micropost::find($id);

        return view('users.edit', [
            'micropost' => $micropost,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $micropost = Micropost::find($id);
        $micropost->content = $request->content;
        $micropost->save();
        
        return redirect('/');
    }
    
    public function destroy($id)
    {
        $micropost = \App\Micropost::find($id);
        //認証idと投稿者のユーザーidが一致しているかをチェック
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }

        return back();
    }
}
