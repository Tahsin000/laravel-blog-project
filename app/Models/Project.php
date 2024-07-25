<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $guarded = [];
    
    // protected $fillable = ['image', 'title', 'description', 'url'];

    public $table='project';
}
