<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $withCount = [
        'users',
        'posts',
    ];

    protected $with = [
        'creator',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'admin_community', 'community_id', 'user_id');
    }
}
