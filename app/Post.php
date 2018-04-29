<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Media;
use App\Like;

class Post extends Model{

    protected $fillabel = [
        'title',
        "text"
    ];
    protected $appends = ['total_likes'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function media(){
        return $this->hasOne(Media::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function getTotalLikesAttribute(){
        return $this->likes->count();
    }
}