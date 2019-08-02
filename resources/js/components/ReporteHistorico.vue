<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="new-class">
                    REPORTE HISTORICO DE UN ELEMENTO
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
            <div class="col-12 col-sm-4 input-group mb-2">
                <select class="custom-select" v-model="criterio">
                    <option value="null" disabled>Buscar por</option>
                    <option value="code">Codigo</option>
                    <option value="name">Nombre</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 input-group mb-2">
                <input type="text" class="form-control" v-model="buscar" @keyup.enter="listarProductos(buscar,criterio)" placeholder="Valor a buscar">
            </div>
            <div class="col-12 col-sm-2 input-group mb-2">
                <button class="btn btn-primary mb-2" type="button" @click="listarProductos(buscar,criterio)">Buscar</button>
            </div>
            <table class="table mb-3 table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product) in arrayProductos" :key="product.id">
                        <td v-text="product.code"></td>
                        <td v-text="product.name"></td>
                        <td v-text="product.stock"></td>
                        <td v-text="product.sizeName"></td>
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
        <div class="row" v-if="productoSeleccionado">
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
            listarProductos(buscar, criterio){
                if(this.criterio === 'null') return console.log('Seleccione un filtro de busqueda');
                let me = this;
                let url = '/producto?buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    if(!respuesta.products.data[0]) return console.log('No se encontraron coincidencias con el codigo')
                    me.arrayProductos=respuesta.products.data;
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

                let url = '/getProductWarehouse?warehouse_id='+ this.warehouse + '&product_id=' + this.arrayProductos[0].id;
                console.log(url);
                axios.get(url).then(response => {
                    let url2 = `../generateHistoricalPDF?`
                                +`id=${response.data.id}`
                                +`&category=${this.category}`
                                +`&serie=${this.serie}`
                                +`&state=${this.state}`
                                +`&size=${this.size}`
                                +`&brand=${this.brand}`;
                    window.open(url2, '_blank');
                })
                .catch( error => {
                    console.log('Elemento no encontrado en el almacen seleccionado');
                    // console.log(error.response);
                })
                this.productoSeleccionado = false;
                this.arrayProductos = [];

            },
        }
    }
</script>
