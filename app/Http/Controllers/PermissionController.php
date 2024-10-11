<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //Método para listar todos los permisos
    public function index(){

    }

    //Método para crear un nuevo permiso
    public function create(){
        return view('permissions.create');
    }

    //Método para almacenar un nuevo permiso
    public function store(Request $request) {
    $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);
        
        if($validator->passes()){
        }else{
            return redirect()->route('permissions.create')->withInput()->withErrors();
        }
    }

    //Método para editar un permiso
    public function edit(){

    }

    //Método para actualizar un permiso
    public function update(){

    }

    //Método para eliminar un permiso
    public function destroy(){

    }
}
