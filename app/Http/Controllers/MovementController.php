<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movimientos.ingreso');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mov = new App\Movement;
        $mov->movement_type_id = $request->movement_type_id;
        $mov->document_type_id = $request->document_type_id;
        $mov->document_number = $request->document_number;
        $mov->date = $request->date;
        $mov->location = '';//Location
        (isset($request->buyer)) ? $mov->buyer = $request->buyer : $mov->buyer = NULL;
        (isset($request->authorizer)) ? $mov->authorizer = $request->authorizer : $mov->authorizer = NULL;
        (isset($request->deliverer)) ? $mov->deliverer = $request->deliverer : $mov->deliverer = NULL;
        (isset($request->reciever)) ? $mov->reciever = $request->reciever : $mov->reciever = NULL;
        (isset($request->courier_description)) ? $mov->courier_description = $request->courier_description : $mov->courier_description = NULL;
        (isset($request->origin)) ? $mov->origin = $request->origin : $mov->origin = NULL;
        (isset($request->destination)) ? $mov->destination = $request->destination : $mov->destination = NULL;
        $mov->save();

        // Meter en la tabla movimiento_producto
        $products = $request->products;
        foreach ($products as $item) {
            $product = App\Product::findOrFail($item['id']);
            if($request->movement_type_id == 1 || $request->movement_type_id == 2) {
                $product->stock = $product->stock + $item['quantity'];
            }
            elseif($request->movement_type_id == 3 || $request->movement_type_id == 4) {
                $product->stock = (int)$product->stock - (int)$item['quantity'];
            }
            $product->save();

            $det = new App\MovementProduct;
            $det->movement_id = $mov->id;
            $det->product_id = $item['id'];
            $det->quantity = $item['quantity'];
            $det->save();
        }
        // return response()->json([$request->all()]);
        return [
            'products' => $products
        ];
        //Actualizar la tabla products
        //If el tipo de movimiento
            //Foreach registro
        //Sumar si es ingreso.
        //Ingreso compra es tipo movimiento 1
        //Ingreso por retorno es tipo movimiento 2


        //Restar si es salida
        //Salida entre Almacenes es tipo movimiento 3
        //Salida para Obra es tipo movimiento 4
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
        //
    }

}
