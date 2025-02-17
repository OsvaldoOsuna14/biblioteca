<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoanDetail extends Model
{
    protected $table = 'detalles_prestamo';

    protected $fillable = [
        'id_prestamo',
        'id_libro'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_prestamo');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_libro');
    }
}