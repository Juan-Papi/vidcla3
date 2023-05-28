<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{

    public function __construct()
    {
       $this->middleware('can:Listar usuarios')->only('index');
       $this->middleware('can:Editar usuarios')->only('edit', 'update');
    }
    public function index()
    {
        return view('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    { 
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user);
    }
}
