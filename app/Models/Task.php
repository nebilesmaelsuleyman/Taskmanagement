<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;;

class Task extends Model
{
    use HasFactory; 
    use Searchable;
    
    
    public function users(){
        return $this->belongsToMany(user::class, 'task_user', 'task_id', 'user_id');
    }
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'assinged_id'

    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description'=>$this->description
            // Add other searchable attributes
        ];
        
 
        
    }
}


