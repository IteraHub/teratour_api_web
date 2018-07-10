<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

/**
 * App\Media
 *
 * @property int $id
 * @property string $media_url
 * @property int $post_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Media extends Model {
    public function post(){
        return $this->belongsTo(Post::class);
    }
}