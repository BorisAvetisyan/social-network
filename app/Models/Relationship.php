<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'relationships';
    public $timestamps = true;

    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';

}
