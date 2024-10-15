<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:delete roles', only: ['destroy']),
            new Middleware('role:admin', only: ['index, create, store, edit, update, destroy']),
        ];
    }
    public function index(){
        $roles = Role::orderBy('name', 'ASC')->paginate(8);
        return view('roles.list', [
            'roles' => $roles
        ]);
             
    }

    public function create(){
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);
        
        if($validator->passes()){
             
            $role = Role::create(['name' => $request->name]);

            if(!empty($request->permissions))
            {
                foreach($request->permissions as $name){
                    $role->givePermissionTo($name);
                }
            }
        
            return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');

        }else{
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }   

    public function update($id, Request $request){

        $role = Role::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.',id'
        ]);
        
        if($validator->passes()){
             
            $role->name = $request->name;
            $role->save();

            if(!empty($request->permissions))
            {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
        
            return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');

        }else{
            return redirect()->route('roles.create', $id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){

        $id = $request->id;
        $role = Role::findOrFail($id);

        if ($role == null){
            session()->flash('error', 'Rol no encontrado');
            return response()->json([
                'status' => false,
            ]);
        }

        $role->delete();

        session()->flash('success', 'Rol eliminado correctamente');
        return response()->json([
            'status' => true,
        ]);
    }

}
