<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('personal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí, obtenemos todos los usuarios que no están asociados con ningún Personal.
        $users = User::whereDoesntHave('personal')->get();

        // Pasamos la lista de usuarios a la vista.
        return view('personal.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'carnet' => 'required|integer|unique:personals',
            'nombre' => 'required|string|max:255',
            'materno' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'sexo' => 'required|string|max:1',
            'cargo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);
    
        $personal = new Personal($validatedData);
        $personal->save();
    
        return redirect()->route('personal.index')
            ->with('info', 'Personal creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personal $personal)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personal $personal)
    {
      // Consigue todos los usuarios que no tienen un personal asignado o son el usuario actual del personal que estamos editando
    $users = User::doesntHave('personal')->orWhere('id', $personal->user_id)->get();

    return view('personal.edit', compact('personal', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personal $personal)
    {
        $request->validate([
            'carnet' => 'required|integer|unique:personals,carnet,' . $personal->id,
            'nombre' => 'required|string',
            'materno' => 'required|string',
            'paterno' => 'required|string',
            'sexo' => 'required|string',
            'cargo' => 'required|string',
            'estado' => 'required|string',
            'pais' => 'required|string',
            'ciudad' => 'required|string',
            'user_id' => 'nullable|exists:users,id|unique:personals,user_id,' . $personal->id
        ]);
    
        // Si el user_id del request es diferente al user_id actual del Personal
        if ($request->user_id != $personal->user_id) {
    
            // Si el Personal actual tiene un User asociado, desasociar
            if ($personal->user) {
                $personal->user()->dissociate();
                $personal->save();
            }
    
            // Si se proporcionó un user_id en el request, encontrar ese User y asociarlo con este Personal
            if ($request->user_id) {
                $user = User::find($request->user_id);
                $personal->user()->associate($user);
                $personal->save();
            }
        }
    
        // Actualizar el Personal con los datos del request
        $personal->update($request->except('user_id'));
    
        return redirect()->route('personal.index')->with('info', 'Personal actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect()->route('personal.index')
            ->with('info', 'Personal eliminado exitosamente.');
    }
}
