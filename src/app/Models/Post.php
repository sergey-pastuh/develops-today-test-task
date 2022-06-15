<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = array('is_liked_by_current_user');

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getIsLikedByCurrentUserAttribute()
    {
        $redis = Redis::connection();
        $upvotedUsers = json_decode($redis->command('HGET', ['upvoted-posts', $this->id]), true);

        return in_array(Auth::id(), $upvotedUsers ?? []);
    }
}
