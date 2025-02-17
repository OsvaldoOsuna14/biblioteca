<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', compact('users'));    
    }

    public function store(Request $request)
    {
        $request->validate([
          'username' => 'required|unique:usuarios',
          'password' => 'required|min:8',
          'confirm_password' => 'required|same:password',
          'correo' => 'required|email|unique:usuarios',
            'nombre' => 'required',
            'apellidos' => 'required',
            'rol' => 'required|in:recepcionista,cliente',
        ]);

        $valited['password'] = Hash::make($request->password);
        User::create($valited);
    }

    public function edit($id)
    {
      
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'username' => 'required|unique:usuarios,username,'.$user->id,
            'correo' => 'required|email|unique:usuarios,correo,'.$user->id,
            'nombre' => 'required',
            'apellidos' => 'required',
            'rol' => 'required|in:recepcionista,cliente',
        ]);

        if($request->filled('password')){
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'same:password',
            ]);
            $valited['password'] = Hash::make($request->password);
        }

        $user->update($valited);

        return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente');

    }


    public function detele(User $user)
    {

        if($user->loans()->where('estado','Activo')->exists()){
            return redirect()->route('user.index')->with('error', 'No se puede eliminar el usuario porque tiene prestamos activos');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente');
    }



    public function createCliente()
    {
        return view('client.create');
    }


    public function indexCliente()
    {
        $clients = User::where('rol', 'cliente')
        ->withCount(['loans' => function($query) {
            $query->where('estado', 'Activo');
        }])
        ->get();

        return view('client.index', compact('clients'));
    }

    public function storeCliente(Request $request){
        $request->validate([
            'correo' => 'required|email|unique:usuarios',
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'rol' => 'cliente'
        ]);
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'Cliente registrado exitosamente'
            ]);
        }
    
        
        return redirect()->route('clients.index')->with('success', 'Cliente registrado exitosamente');
    }

    public function editCliente($id)
    {
        $client = User::findOrFail($id);
        return view('client.edit', compact('client'));
    }

    public function updateCliente(Request $request, User $user)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo,'.$user->id,
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function deleteCliente(User $user)
    {
        if($user->loans()->where('estado','Activo')->exists()){
            return redirect()->route('clients.index')->with('error', 'No se puede eliminar el cliente porque tiene prestamos activos');
        }
        $user->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado correctamente');
    }
    

    public function indexRecepcionista()
    {
        $receptionists = User::where('rol', 'recepcionista')->get();
        return view('receptionist.index', compact('receptionists'));
    }

    public function createRecepcionista()
    {
        return view('receptionist.create');
    }

    public function storeRecepcionista(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:usuarios',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'correo' => 'required|email|unique:usuarios',
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        $valited= $request->all();
        $valited['password'] = Hash::make($request->password);
        $valited['rol'] = 'recepcionista';
        User::create($valited);

        return redirect()->route('receptionists.index')->with('success', 'Recepcionista registrado correctamente');


    }

    public function editRecepcionista($id)
    {
        $receptionist = User::findOrFail($id);
        return view('receptionist.edit', compact('receptionist'));
    }

    public function updateRecepcionista(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:usuarios,username,'.$user->id,
            'correo' => 'required|email|unique:usuarios,correo,'.$user->id,
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        if($request->filled('password')){
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'same:password',
            ]);
            $valited['password'] = Hash::make($request->password);
        }

        $user->update($valited);

        return redirect()->route('receptionists.index')->with('success', 'Recepcionista actualizado correctamente');
    }


    public function deleteRecepcionista(User $user)
    {
        $user->delete();
        return redirect()->route('receptionists.index')->with('success', 'Recepcionista eliminado correctamente');
    }


}