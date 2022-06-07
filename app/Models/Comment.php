<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['time', 'content','like','user_id','product_id','created_at','updated_at'];
    protected $table ="comment";
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
