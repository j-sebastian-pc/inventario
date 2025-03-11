<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Papeleria;

class PapeleriaController extends Controller
{
    /**
     * Mostrar una lista de todos los productos de papelería.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productos = Papeleria::all();
        return response()->json(['productos' => $productos]);
    }

    /**
     * Almacenar un nuevo producto de papelería.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'existencias' => 'required|integer|min:0',
        ]);

        $producto = Papeleria::create($request->all());
        
        return response()->json([
            'mensaje' => 'Producto creado correctamente',
            'producto' => $producto
        ], 201);
    }

    /**
     * Actualizar un producto de papelería existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $producto = Papeleria::findOrFail($id);
        
        $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
            'precio' => 'numeric|min:0',
            'existencias' => 'integer|min:0',
        ]);

        $producto->update($request->all());
        
        return response()->json([
            'mensaje' => 'Producto actualizado correctamente',
            'producto' => $producto
        ]);
    }

    /**
     * Eliminar un producto de papelería.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $producto = Papeleria::findOrFail($id);
        $producto->delete();
        
        return response()->json([
            'mensaje' => 'Producto eliminado correctamente'
        ]);
    }
}