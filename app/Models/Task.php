<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function comment()
    {
        return $this->hasmany(comment::class);
    }
    public function users(){
        return $this->belongsToMany(user::class);
    }
}
