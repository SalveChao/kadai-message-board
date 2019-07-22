<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    //フォローしているuserを取得可能に
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    //フォロワーの取得を可能に
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    //フォローする
    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        if($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    //followを解除
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        if ($exist && !$its_me) {
            $this->followings()->detach($userId); // 既にフォローしていればフォローを外す
            return true;
        } else {
            return false;            // 未フォローであれば何もしない
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    //micropostを取得する記述
    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    //多対多(user_idとmicropost_id)
    public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id');
    }

    //お気に入り登録
    public function favorite($micropostId)
    {
     $exist = $this->is_favorite($micropostId);   // 既にお気に入りしているかの確認
    
        if ($exist) {
            return false;            // 既にお気に入りなら何もしない
        } else {
            $this->favorites()->attach($micropostId);   // 未お気に入りであればお気に入り登録する
            return back();
        }
    }
    //お気に入り解除
    public function unfavorite($micropostId)
    {
        $exist = $this->is_favorite($micropostId);  // 既にお気に入りしているかの確認
    
        if ($exist) {
        $this->favorites()->detach($micropostId);  // 既にお気に入りしていれば登録解除
        return true;
        } else {
        return false;            // 未お気に入りであれば何もしない
        }
    }
    //お気に入り中
    public function is_favorite($micropostId)
    {
        return $this->favorites()->where('micropost_id', $micropostId)->exists();
    }
    
}
