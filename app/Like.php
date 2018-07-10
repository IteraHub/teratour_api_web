<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

/**
 * App\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Post $post
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Like whereUserId($value)
 * @mixin \Eloquent
 */
class Like extends Model {

    protected $fillable =['post_id','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}