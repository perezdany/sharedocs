<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = true;
    protected $fillable = [
        'nom_prenoms',
        'entreprise',
        'fonction',
        'email',
        'password',
        'telephone',
        'groupes_id',
        'active',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function groupes()
    {
        //dump($this->belongsTo(Groupe::class));
        return $this->belongsTo(Groupe::class);
        
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }

    public function hasPermission($permission)
    {
        return $this->permissions()->where('libele', $permission)->first() !== null;

    }

    public function hasGroupe($groupe)
    {
        //dd($this->groupes()->where('titre', $groupe)->first() );
        return $this->groupes()->where('titre', $groupe)->first() !== null;

    }


}
