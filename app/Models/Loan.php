<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'prestamos';

    protected $fillable = [
        'id_cliente',
        'creado_por',
        'cerrado_por',
        'fecha_prestamo',
        'fecha_limite',
        'fecha_devolucion',
        'estado',
    ];

protected $casts = [
    'fecha_prestamo' => 'datetime',
    'fecha_limite' => 'datetime',
    'fecha_devolucion' => 'datetime',
    'estado' => 'string'
];

public function client()
{
    return $this->belongsTo(User::class, 'id_cliente');
}

public function creator()
{
    return $this->belongsTo(User::class, 'creado_por');
}

public function closer()
{
    return $this->belongsTo(User::class, 'cerrado_por');
}

public function books()
{
    return $this->belongsToMany(Book::class, 'detalles_prestamo', 'id_prestamo', 'id_libro');

}

}
