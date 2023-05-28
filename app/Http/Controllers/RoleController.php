<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
   
    public function __construct()
    {
       $this->middleware('can:Listar role')->only('index');
       $this->middleware('can:Crear role')->only('create', 'store');
       $this->middleware('can:Editar role')->only('edit', 'update');
       $this->middleware('can:Eliminar role')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);
        //Ej: al role se le esta asignando el permisio 1,2,3
        //$role->permissions()->attach([1,2,3]); esta forma trae posibles errores 
        //cuando ya tiene ese dicho permiso y se le vuelve a asignar

        //EL sync elimina los permisos que tiene dicho rol(si ya hubieran) 
        //y agrega los permisos 1, 2, 3 (Ambos attach y sync agregan a la tabla intermedia)
        //attach y sync son exclusivos para las relaciones de muchos a muchos
        //$role->permissions()->sync([1,2,3]);

        //Sabido lo anterior se deduce que es mejor usar sync
        $role->permissions()->sync($request->permissions);

        return Redirect()->route('admin.roles.index')->with('info', 'El Rol se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);
       
       //otra forma de actualizar sin ocupar save()
       /*$role->update([
            'name' => $request->name 
       ]);*/
       
        $role->name = $request->name;   
        $role->permissions()->sync($request->permissions);
        $role->save();
        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('info', 'El Rol se elimino con éxito');
    }
}
