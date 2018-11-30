<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Retorna todos los productos
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Registrar un  nuevo producto
    public function store(Request $request)
    {
        $product = Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'units'=>$request->units,
            'price'=>$request->price,
            'image'=>$request->image
        ]);

        return response()->json([
            'status'=>(bool)$product,
            'data'=>$product,
            'message'=>$product ? 'Product Created' : 'Error Creating Product'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    //Retorna todos los productos
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

//    Carga la imagen de un producto creado y retorna la url para el producto
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image'))
        {
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'),$name);
        }
        return response()->json(asset("images/$name"),201);
    }


    // Actualiza los datos de un producto
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name','description','units','price','image'])
        );

        return response()->json([
            'status'=> $status,
            'message'=>$status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    // Agregar una nueva unidad a un producto
    public function updateUnits(Request $request, Product $product)
    {
        $product->units = $product->units + $request->get('units');
        $status = $product->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }

    //Eliminar un producto
    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
