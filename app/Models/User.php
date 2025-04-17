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
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
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

    public function posts(){
        //One to Many
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(like::class);
    }
    //Almacena los seguidores de un usuario
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

     //Almacena a los que seguimos
     public function followins(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Comporbar si un usario ya sigue a otro
    public function siguiendo(User $user)
    {
        //Contains itera sobre toda la tabla de followers
        return $this->followers->contains($user->id);
    }

    //Almacenar los que seguimos

}
