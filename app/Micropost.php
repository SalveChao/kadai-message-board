<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //create関数で一気にデータ保存可能に
    protected $fillable = ['content', 'user_id'];
    
    //一対多
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //多対多
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id');
    }
    
}
