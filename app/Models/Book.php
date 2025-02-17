<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'libros';

    protected $fillable = [
        'titulo',
        'autor',
        'url_imagen',
        'total_piezas',
        'piezas_disponibles',
        'estado'
    ];

    public function loans()
    {
        return $this->belongsToMany(Loan::class, 'detalles_prestamo', 'id_libro', 'id_prestamo');
    }
}