<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos =Producto::orderBy('id','DESC')->paginate(3);
        return view('Producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 'nombre'=>'required', 'precio'=>'required',
        'idcat'=>'required', 'stock'=>'required']);
        Producto::create($request->all());
        return redirect()->route('producto.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('producto.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('Producto.edit',compact('producto'));
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
          $this->validate($request,[ 'nombre'=>'required', 'precio'=>'required',
        'idcat'=>'required', 'stock'=>'required']);

          Producto::find($id)->update($request->all());
          return redirect() -> route('producto.index')->with('success','Registro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::find($id)->delete();
        return redirect()->route('producto.index')->with('success','Registro eliminado satisfactoriamente');
    }


    public function getProductos(){
        $producto = Producto::all();
        return response()->json($producto);
        }



}
