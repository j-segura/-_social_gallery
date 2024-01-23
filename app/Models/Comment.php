<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function autor() {
        return $this->belongsTo('App\Models\User', 'autor_id');
    }

    public function picture() {
        return $this->belongsTo('App\Models\Picture');
    }
}
