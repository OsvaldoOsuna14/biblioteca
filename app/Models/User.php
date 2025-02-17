<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'username',
        'password',
        'nombre',
        'apellidos',
        'correo',
        'rol'
    ];

    protected $hidden = [
        'password',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'id_cliente');
    }
}