<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $fillable=[
        'comment'
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
