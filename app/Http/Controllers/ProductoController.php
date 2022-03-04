<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\tipoproducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
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
        $productos = Auth::user()->productos;
        return view('Producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoproducto = tipoproducto::all();
        return view('Producto.create', compact('tipoproducto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de datos de los productos, para que estos sean requeridos en el formulario
        $data = $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'tipoproducto' => 'required',
        ]);
        // insercion con sentencia SQL
        /* DB::table('productos')->insert([
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'id_tipoproducto' => $data['tipoproducto'],
            'QR' => '1',
            'ganancia' => '1',
            'id_usuario' => Auth::user()->id,
        ]); */
        // insercion de datos usando el modelo de laravel (proteje los datos al hacer la insercion)
        Auth::user()->productos()->create([
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'id_tipoproducto' => $data['tipoproducto'],
            'QR' => '1',
            'ganancia' => ($data['precio'] * 1.35),
        ]);
        return redirect()->route('Producto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('Producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
    }
}