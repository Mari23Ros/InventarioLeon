<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function historico(){
        return view('reportes.historico');
    }

    public function query(){
        return view('consultaGeneral');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Obtener el id de la tabla product_warehouse
     */
    public function getProductWarehouse(Request $request){
        $id = App\ProductWarehouse::where('warehouse_id', '=', $request->warehouse_id)
                            ->where('product_id', '=', $request->product_id)
                            ->first();

        return [
            'id' => $id->id
        ];
    }
    public function getWarehouseId(Request $request){
        $id = App\ProductWarehouse::where('warehouse_id', '=', $request->warehouse_id)->first();

         return [
           'id' => $id->id
         ];
    }

    /**
     * Generacion del PDF
     */
    public function generateHistoricalPDF(Request $request){
        //Obtener exactamente el elemento que estamos buscando(su product_id y warehouse_id)
        $productWarehouse = App\ProductWarehouse::where('id','=', $request->id)->first();
        //Obtener exactamente el elemento que estamos buscando(su product_id y warehouse_id)
        $warehouse = App\Warehouse::where('id','=', $productWarehouse->warehouse_id)->first();
        //Obtener el product_id e informacion relacionada al producto
        $product = App\Product::where('products.id', '=', $productWarehouse->product_id)
                                ->join('categories','products.category_id','=','categories.id')
                                ->join('states','products.state_id','=','states.id')
                                ->join('sizes','products.size_id','=','sizes.id')
                                ->select('products.*', 'categories.name as categoryName', 'states.name as stateName', 'sizes.name as sizeName')
                                ->orderBy('products.id','desc')
                                ->first();
        //Obtener en que movimientos se vio afectado el producto en cuestion
        //considerando que salio o entro desde el almacen del que pertenece
        $movement = App\Movement::where('origin', '=', $productWarehouse->warehouse_id)
                            ->orWhere('destination', '=', $productWarehouse->warehouse_id)
                            ->get();
        $arrayProductos = [];
        foreach ($movement as $key => $mov) {
            $movementType = App\MovementType::where('id', '=', $mov->movement_type_id)->first();
            //Validacion de que existe un almacen
            if(count((array)$movementType) === 0) continue;
            $movementProduct = App\MovementProduct::where('movement_id', '=', $mov->id)
                                        ->where('product_id', '=', $product->id)
                                        ->first();
            //Validacion de que existieron movimiento de productos
            if(count((array)$movementProduct) === 0) continue;
            $arrayProductos[$key]= [
                'movement_type' => $movementType->name,
                'quantity' => $movementProduct->quantity,
                'date' => $mov->created_at,
            ];
        }

        $arrayInfo = [];
        $arrayInfo['id'] = $product->id;
        $arrayInfo['warehouse'] = $warehouse->name;
        $arrayInfo['name'] = $product->name;
        $arrayInfo['code'] = $product->code;
        $arrayInfo['description'] = $product->description;
        $arrayInfo['stock'] = $productWarehouse->stock;
        if ($request->category == true) $arrayInfo['category'] = $product->categoryName;
        if ($request->state == true) $arrayInfo['state'] = $product->stateName;
        if ($request->size == true) $arrayInfo['size'] = $product->sizeName;
        if ($request->brand == true) $arrayInfo['brand'] = $product->brand;
        if ($request->serie == true) $arrayInfo['serie'] = $product->serie;
        //Conversion a un objeto para enviarlo a la vista
        $objectProducts = (object)$arrayProductos;
        $objectInfo = (object)$arrayInfo;

        // Para mostrar la informacion ez
        // echo '<pre>';
        // echo print_r($objectInfo);
        // echo '</pre>';

        $pdf = PDF::loadView('pdfHistorico', compact('objectProducts','objectInfo'));

        //Para descargar defrente con un nombre
        //return $pdf->download('itsolutionstuff.pdf');

        // Para mostrarlo en el navegador ez
        return $pdf->stream();
    }
    public function querypdf(Request $request)
        {
            $warehouse = $request->warehouse;
            if($warehouse ==''){
                $products = App\ProductWarehouse::all();
            } else {
                $products = App\ProductWarehouse::where('product_warehouse.warehouse_id','=',$warehouse)
                            ->select('product_warehouse.product_id as id', 'stock')
                            ->orderBy('product_warehouse.id','desc')
                            ->paginate(50);
            }

            $almacen = App\Warehouse::where('warehouses.id','=', $warehouse)->first();

            $arrayProducts = [];
            foreach ($products as $key => $product) {
                $consulta = App\Product::where('id', '=', $product->id)->first();
                $arrayProducts[$key] = $consulta;
                $categoryName = App\Product::find($product->id)->category()->first();
                $stateName = App\Product::find($product->id)->state()->first();
                $sizeName = App\Product::find($product->id)->size()->first();
                $calibrationName = App\Product::find($product->id)->calibration()->first();
                if($categoryName->id === 1){
                    //consulta para obtener la calibracoin
                    $arrayProducts[$key]['calibration_details'] = $calibrationName->details;
                    $arrayProducts[$key]['calibration_last'] = $calibrationName->last;
                    $arrayProducts[$key]['calibration_next'] = $calibrationName->next;
                    //asignas que tenga calibracion
                }
                $arrayProducts[$key]['category_name'] = $categoryName->name;
                $arrayProducts[$key]['state_name'] = $stateName->name;
                $arrayProducts[$key]['size_name'] = $sizeName->name;
                $arrayProducts[$key]['stock'] = $product->stock;
            
                
            }
                 
            $arrayProducts['warehouse'] = $almacen->name;

            $objectInfo = (object)$arrayProducts;

            $pdf = PDF::loadView('pdfConsulta', compact('objectInfo'));    
            //return [
            // 'products' => $arrayProducts   
            // ];
    
            //return view('consultaGeneral', compact('warehouses'));
        
            return $pdf->stream();
    }
}
 