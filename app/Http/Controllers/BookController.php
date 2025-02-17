<?php

namespace   App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller{


    public function index(){
        $books = Book::all();
        return view('book.index', compact('books'));
    }  


    public function create(){
        return view('book.create');
    }

    public function store(Request $request){
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'url_imagen' => 'required',
            'total_piezas'  => 'required|integer|min:1',
       
        ]);

        $data = $request->all();
        $data['piezas_disponibles'] = $request->total_piezas;


        Book::create($data);
        return redirect()->route('book.index')->with('success', 'Libro creado correctamente');
    }


    public function edit($id){
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, Book $book){
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'url_imagen' => 'required',
            'total_piezas'  => 'required|integer|min:1',
            'piezas_disponibles' => 'required|integer|min:1|max:'.$request->total_piezas

        
        ]);

        $book->update($request->all());
        return redirect()->route('book.index')->with('success', 'Libro actualizado correctamente');
    }

    public function delete($id){
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Libro eliminado correctamente');
    }

    




}