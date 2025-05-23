<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        //Uno a uno
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
