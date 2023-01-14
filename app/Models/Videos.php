<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videos extends Model
{
    use SoftDeletes;

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    // public function categories(){
    //     return $this->belongsTo(categories::class, 'id');
    // }
    // public function genres(){
    //     return $this->hasMany(Genre::class);
    // }
}
