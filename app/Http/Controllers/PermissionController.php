<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    //Método para listar todos los permisos
    public function index(){
      
        $permissions = Permission::orderBy('created_at','DESC')->paginate(8);
        return view('permissions.list', [
            'permissions' => $permissions
        ]);
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
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permiso creado correctamente');

        }else{
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    //Método para editar un permiso
    public function edit($id){
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',[
            'permission' => $permission
        ]);
    }

    //Método para actualizar un permiso
    public function update($id, Request $request){
        
        $permission = Permission::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);
        
        if($validator->passes()){
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permiso actualizado correctamente');

        }else{
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
    }

    //Método para eliminar un permiso
    public function destroy(Request $request){

        $id = $request->id;

        $permission = Permission::find($id);

        if ($permission == null){
            session()->flash('error', 'Permiso no encontrado');
            return response()->json([
                'status' => false,
            ]);
        }

        $permission->delete();
        
        session()->flash('success', 'Permiso eliminado correctamente');
        return response()->json([
            'status' => true,
        ]);
    }
}
