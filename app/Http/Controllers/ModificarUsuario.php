<?php
/**Modelo para controlar la cuenta del usuario logeado */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Hash;
class ModificarUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Usuario.modusuario');  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'new_confirm_password' => 'required|same:new_password',
          ]);
  
          $user = Auth::user();
  
          if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(['msg' => 'La contraseña Actual no coincide']);

          }
          else{
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return back()->with('success', 'Password successfully changed!');
          }
  
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();       
        $user->delete();
    }
}
