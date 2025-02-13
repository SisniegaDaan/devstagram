<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Función que relaciona el modelo Post con el modelo User (Many2one)
    public function user()
    {
        return $this->belongsTo(User::class); //->select(['name', 'username']);
    }

    // Función que relaciona el modelo Post con el modelo Comentario (One2many)
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // Revisa si el post tiene el like del usuario autenticado
        return $this->likes->contains('user_id', $user->id);
    }
}
