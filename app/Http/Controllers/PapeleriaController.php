<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Papeleria;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PapeleriaController extends Controller
{
    /**
     * Obtener todos los productos de papelería.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Obtener todos los productos de papelería
            $productos = Papeleria::all();

            return response()->json([
                'mensaje' => 'Lista de productos obtenida correctamente',
                'productos' => $productos
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los productos', 'detalle' => $e->getMessage()], 500);
        }
    }

    /**
     * Obtener un producto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $producto = Papeleria::findOrFail($id);
            return response()->json([
                'mensaje' => 'Producto obtenido correctamente',
                'producto' => $producto
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener el producto', 'detalle' => $e->getMessage()], 500);
        }
    }

    /**
     * Almacenar un nuevo producto de papelería.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Crear nuevo producto
            $producto = Papeleria::create($request->all());
            
            return response()->json([
                'mensaje' => 'Producto creado correctamente',
                'producto' => $producto
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear el producto', 'detalle' => $e->getMessage()], 500);
        }
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
        try {
            // Buscar el producto por ID
            $papeleria = Papeleria::findOrFail($id);
            
            // Actualizar el producto
            $papeleria->update($request->all());
            
            return response()->json([
                'mensaje' => 'Producto actualizado correctamente',
                'producto' => $papeleria
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar el producto', 'detalle' => $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar un producto de papelería.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Buscar el producto por ID
            $producto = Papeleria::findOrFail($id);
            
            // Eliminar el producto
            $producto->delete();

            return response()->json([
                'mensaje' => 'Producto eliminado correctamente'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar el producto', 'detalle' => $e->getMessage()], 500);
        }
    }
}