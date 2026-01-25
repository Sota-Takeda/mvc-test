<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    'user_id',
    'title',
    'author',
    'status',
    'memo',
    'started_at',
    'finished_at',
    ];
}
