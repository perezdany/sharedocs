<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'nom_folder',
        'description',
        
    ];
}
