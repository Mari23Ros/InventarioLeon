<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="new-class">
                    CONSULTA GENERAL POR ALMACÉN
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Almacen</div>
                </div>
                <select class="custom-select" v-model="warehouse">
                    <option selected disabled value="null">Choose...</option>
                    <option v-for="ware in arrayWarehouses" :key="ware.id" :value="ware.id">{{ ware.name }}</option>
                </select>
            </div>
            <div class="col-12 col-sm-2 input-group mb-2">
                <button class="btn btn-primary mb-2" type="button" @click="listarProductos(warehouse)">Buscar</button>
            </div>
            <table class="table mb-3 table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Marca</th>
                        <th scope="col">N° de Serie</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Calibracion</th>
                        <th scope="col">Fecha calibracion</th>
                        <th scope="col">Fecha Proxima calibracion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in arrayProductos" :key="product.id">
                        <td v-text="index + 1"></td>
                        <td v-text="product.code"></td>
                        <td v-text="product.name"></td>
                        <td v-text="product.description"></td>
                        <td v-text="product.brand"></td>
                        <td v-text="product.serie"></td>
                        <td v-text="product.state_name"></td>
                        <td v-text="product.size_name"></td>
                        <td v-text="product.stock"></td>
                        <td v-text="product.calibration_details"></td>
                        <td v-text="product.calibration_last"></td>
                        <td v-text="product.calibration_next"></td>
                        
                        <td>
                            <button type="button" class="btn btn-outline-secondary" @click="seleccionarProducto(product)">Seleccionar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3" v-if="productoSeleccionado">
            <div>Incluir:&nbsp;</div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="category" value="category" v-model="category">
                <label class="form-check-label" for="category" >Categoria</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="brand" value="brand" v-model="brand">
                <label class="form-check-label" for="brand">Marca</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="serie" value="serie" v-model="serie">
                <label class="form-check-label" for="serie">Numero de Serie</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="state" value="state" v-model="state">
                <label class="form-check-label" for="state">Estado</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="size" value="size" v-model="size">
                <label class="form-check-label" for="size">Unidad</label>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-3">
                <button type="button" class="btn btn-primary btn-lg btn-block" @click="enviarTodo()">Generar Reporte</button>
            </div>
            <div class="col-6 mb-3">
                <button type="button" class="btn btn-secondary btn-lg btn-block" @click="descargarPDF()">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                criterio:'null',
                buscar:'',
                warehouse:'null',
                arrayWarehouses: [],
                arrayProductos: [],
                productoSeleccionado: false,
                category:0,
                brand:0,
                serie:0,
                state:0,
                size:0,
            }
        },
        mounted() {
            console.log('OPCION REPORTE HISTORICO');
            this.listarSelects();
        },
        methods:{
            listarSelects(){
                let me = this;
                let url = '/producto/getWarehouseOnly';
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    me.arrayWarehouses=respuesta.warehouses;
                })
                .catch(function(error){
                    console.log(error.response)
                });
            },
            listarProductos(warehouse){
                if(this.warehouse === 'null') 
                return console.log('Seleccione un filtro de busqueda');
                let me = this;
                let url = '/consulta?warehouse='+warehouse;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    console.log(response);
                    if(!respuesta.products[0]) {
                        return console.log('No se encontraron registros')
                    }
                    me.arrayProductos=respuesta.products;
                    //return console.log(warehouse);
                })
                .catch(function(error){
                    console.log(error.response)
                });
                this.productoSeleccionado = false;

            },
            seleccionarProducto(producto){
                this.arrayProductos=[];
                this.arrayProductos.push(producto);
                console.log(this.arrayProductos);
                this.productoSeleccionado = true;
            },
            enviarTodo(){
                if(this.warehouse === 'null') return console.log('Seleccione un almacen');
                let url = '/getWarehouseId?warehouse_id='+ this.warehouse ;
                  window.location.assign(`../querypdf?`
                               )

                .catch( error => {
                    console.log('Elemento no encontrado en el almacen seleccionado');
                    // console.log(error.response);
                })

            },
        }
    }
</script>
