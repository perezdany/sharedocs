<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'titre',
    ];

    public function users()
    {
        //dump($this->hasMany(User::class));
        $this->hasMany(User::class);
    }
}
