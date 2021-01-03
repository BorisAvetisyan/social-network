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

}
