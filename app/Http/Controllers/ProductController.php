<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App;

class ProductController extends Controller
{

    public function newproduct()
    {
       $categories = App\Category::all();
       $states = App\State::all();
       $sizes = App\Size::all();
       $products = App\Product::all();
       //$products = App\Product::all();
       return view('productnew', compact('categories','states','sizes'));
    }
    public function createProduct(Request $request){
        //return $request->all();
        $request->validate([
            'name'=> 'required',
            'code'=> 'required'
        ]);
        $newProduct = new App\Product;


                $newProduct->name = $request->name;
                $newProduct->code = $request->code;
                $newProduct->brand = $request->brand;
                $newProduct->serie = $request->serie;
                $newProduct->category_id = $request->category_id;
                $newProduct->state_id = $request->state_id;
                $newProduct->size_id = $request->size_id;

                $newProduct->description = $request->description;



       $newCalibration =  new App\Calibration;
                $newCalibration->details = $request->details;
                $newCalibration->last = $request->last;
                $newCalibration->next= $request->next;
                $newCalibration->commentary = $request->commentary;

         $newCalibration->save();
         $newProduct->calibration_id = $newCalibration->id;
        $newProduct->save();


       return back()->with('mensaje','Producto agregado!');


    }

    public function searchProduct(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar ==''){
            $products = App\Product::join('sizes','products.size_id','=','sizes.id')
                        ->select('products.*','sizes.name as sizeNamepruebas')
                        ->orderBy('products.id','desc')
                        ->paginate(10);
        } else {
            $products = App\Product::where('products.'.$criterio, 'like', '%'.$buscar.'%')
                        ->join('sizes','products.size_id','=','sizes.id')
                        ->select('products.*','sizes.name as sizeName')
                        ->orderBy('products.id','desc')
                        ->paginate(10);
        }
        return [
            'products' => $products
        ];
    }
    /**
     * Lista los warehouses y los Users
     */
    public function getWarehouseUsers(){
        $warehouses = App\Warehouse::all();
        $users = App\User::all();
        return [
            'warehouses' => $warehouses,
            'users' => $users
        ];
        // return view('productnew', compact('warehouses','users'));
    }
    /**
     * Lista solo los warehouses
     */
    public function getWarehouseOnly(){
        $warehouses = App\Warehouse::all();
        return [
            'warehouses' => $warehouses
        ];
    }

    public function getWarehousesForBuyer(){
        // $destinations = App\Warehouse::where('name', 'like', '%central%');
        $destinations = App\Warehouse::where('name', 'like', '%central%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
        return [
            'destinations' => $destinations
        ];
    }
    public function consultaGeneral(Request $request)
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
        
            //echo '<pre>';
            //print_r($arrayProducts);
            //echo '</pre>';
            
        return [
           'products' => $arrayProducts
            
        ];

        //return view('consultaGeneral', compact('warehouses'));
    }
    public function inicio(Request $request)
    {
        $warehouses = App\Warehouse::all();
        $criterio = $request->id;

        $products = App\ProductWarehouse::where('product_warehouse.warehouse_id','=',$criterio)
                        ->join('warehouses','product_warehouse.warehouse_id','=','warehouses.id')
                        ->select('warehouses.id')
                        ->paginate(200);
        
        return view('consultaprueba', ['products' => $products],compact('warehouses'));
    }
}
