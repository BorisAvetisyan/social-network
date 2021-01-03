<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    public $timestamps = true;


    public function madePosts() {
        return $this->hasMany(Post::class, 'sender_id');
    }

    public function receivedPosts() {
        return $this->hasMany(Post::class, 'receiver_id');
    }

    /**
     * Check if user given with the argument is friend of the authenticated user or not
     * @param $user
     * @return bool
     */
    public function isFriend($user) {
        return !empty(Relationship::whereRaw("(receiver_id = $this->id and sender_id = $user->id) or (sender_id = $this->id and receiver_id = $user->id)")
            ->withApprovedStatus()
            ->first());
    }
}
