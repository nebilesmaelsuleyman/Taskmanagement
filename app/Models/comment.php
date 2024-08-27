<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    public function Task(){
        return $this->belongsTo(Task::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
