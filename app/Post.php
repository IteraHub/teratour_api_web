<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Media;
use App\Like;

/**
 * App\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read mixed $latest_comment
 * @property-read mixed $liked_by_user
 * @property-read mixed $total_likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read \App\Media $media
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
 * @mixin \Eloquent
 */
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