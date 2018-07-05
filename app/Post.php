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
    protected $appends = ['total_likes','liked_by_user','latest_comment'];

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
    
    public function getLatestCommentAttribute(){
        return Comment::with(['user'=>function($q){
           $q->select([
            "id",
           "firstname",
           "lastname",
           "about","location","gender",
           "image_url","coverphoto_url",
           "username"]);
        }])->wherePostId($this->id)
                    ->orderBy('id','desc')->first();
    }
    
    public function getLikedByUserAttribute(){
        $user_id = \Auth::user()->id;

        $result = array_search($user_id,array_column($this->likes->toArray(),'user_id'));

        return $result>0;
    }
}