<?php 

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $activeLoans = Loan::where('estado', 'activo')
        ->where('fecha_limite', '>=', Carbon::now())
        ->count();


    $overdueLoans = Loan::where('estado', 'activo')
        ->where('fecha_limite', '<', Carbon::now())
        ->count();


    $availableBooks = Book::sum('piezas_disponibles');
        return view('dashboard.index', compact('activeLoans', 'overdueLoans', 'availableBooks'));
    }


}

