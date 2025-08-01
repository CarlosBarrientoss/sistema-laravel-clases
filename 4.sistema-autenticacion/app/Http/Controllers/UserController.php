<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto=$request->input('texto');
        $registros=User::where('name','like','%'.$texto.'%')
            ->orWhere('email','like','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(10);
        return view('usuario.index',compact('registros','texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.action');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $registro=new User();
        $registro->name=$request->input('name');
        $registro->email=$request->input('email');
        $registro->password=bcrypt($request->input('password'));
        $registro->activo=$request->input('activo');
        $registro->save();
        return redirect()->route('usuarios.index')->with('mensaje','Registro '.$registro->name.' creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $registro=User::findOrFail($id);
        return view('usuario.action',compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $registro=User::findOrFail($id);
        $registro->name=$request->input('name');
        $registro->email=$request->input('email');
        $registro->password=bcrypt($request->input('password'));
        $registro->activo=$request->input('activo');
        $registro->save();
        return redirect()->route('usuarios.index')->with('mensaje','Registro '.$registro->name.' actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro=User::findOrFail($id);
        $registro->delete();
        return redirect()->route('usuarios.index')->with('mensaje', $registro->name. ' eliminado satisfactoriamente.');
    }

    public function toggleStatus(User $usuario){
        $usuario->activo=!$usuario->activo;
        $usuario->save();
        return redirect()->route('usuarios.index')->with('mensaje', 'Estado del usuario actualizado correctamente.');
    }
}
