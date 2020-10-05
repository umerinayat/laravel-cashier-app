<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'isPremium',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getExcerpt() {
        return Str::limit($this->content, 40);
    }
}
