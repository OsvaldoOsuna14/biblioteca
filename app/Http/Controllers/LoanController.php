<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;

class LoanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $loans = Loan::with(['books', 'client', 'creator'])->get();
        return view('loan.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::all();
        $clients = User::where('rol', 'cliente')->get();
        return view('loan.create', compact('books', 'clients'));
    }

    public function store(Request $request)
    {


        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear un préstamo');
        }

        
        $hasActiveLoan = Loan::where('id_cliente', $request->id_cliente)->where('estado', 'Activo')->exists();

        if ($hasActiveLoan) {
            return redirect()->route('loan.create')->with('error', 'El usuario ya tiene un préstamo activo');
        }

        $request->validate([
            'libros' => 'required|array|min:1',
            'libros.*' => 'required|exists:libros,id',
            'id_cliente' => 'required|exists:usuarios,id',
            'fecha_prestamo' => 'required|date',
            'fecha_limite' => 'required|date|after:today',
        ]);

        

        $loan = Loan::create(
            [
                'id_cliente' => $request->id_cliente,
                'creado_por' => auth()->user()->id,
                'fecha_prestamo' => now(),
                'fecha_limite' => $request->fecha_limite,
                'estado' => 'Activo',
            ]
        );


        foreach ($request->libros as $idBook) {
            $book = Book::find($idBook);

            if ($book->piezas_disponibles > 0) {
                $loan->books()->attach($idBook);
                $book->decrement('piezas_disponibles');
            } else {

                return redirect()->route('loan.create')->with('error', "El libro '{$book->titulo}' no tiene unidades disponibles.");
            }
        }

        return redirect()->route('loan.index')->with('success', 'Préstamo creado correctamente');

    }


    public function edit($id)
    {

 

        $loan = Loan::with('books')->find($id);
        $clients = User::where('rol', 'cliente')->get();
        $books = Book::where('piezas_disponibles', '>', 0)->get();

        $loan->fecha_prestamo = Carbon::parse($loan->fecha_prestamo)->format('Y-m-d');
        $loan->fecha_limite = Carbon::parse($loan->fecha_limite)->format('Y-m-d');

        return view('loan.edit', compact('loan', 'clients', 'books'));

    }

    public function update(Request $request, Loan $loan)
    {
        if ($loan->estado === 'Cerrado') {
            return back()->with('error', 'No se puede actualizar un préstamo cerrado');
        }

        $validated = $request->validate([
            'fecha_limite' => 'required|date|after:today',
        ]);

        $loan->update($validated);
        return redirect()->route('loan.show', $loan)->with('success', 'Préstamo actualizado correctamente');
    }


    public function delete(Loan $loan)
    {
        if ($loan->estado != 'Cerrado') {
            return back()->with('error', 'No se puede eliminar un préstamo activo');
        }
        $loan->delete();
        return redirect()->route('loan.index')->with('success', 'Préstamo eliminado correctamente');
    }

    public function close($id){
        $loan = Loan::find($id);
        $loan->update([
            'cerrado_por' => auth()->user()->id,
            'fecha_devolucion' => now(),
            'estado' => 'Cerrado',
        ]);

        foreach ($loan->books as $book) {
            $book->increment('piezas_disponibles');
        }

        return redirect()->route('loan.index')->with('success', 'Préstamo cerrado correctamente');
    }


}