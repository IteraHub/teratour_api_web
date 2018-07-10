<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Post;
/**
 * App\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Post $post
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
