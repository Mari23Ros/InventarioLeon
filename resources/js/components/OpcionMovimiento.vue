<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="new-class">
                    INGRESO DE ELEMENTOS
                </p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Codigo</div>
                </div>
                <input type="text" class="form-control" placeholder="Codigo" v-model="codeProduct" @keyup.enter="enviarCodigo(codeProduct)" @blur="enviarCodigo(codeProduct)" :disabled="editar">
            </div>
            <!-- Modal Busqueda -->
            <div class="col-12 col-sm-2 order-1 order-sm-0">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBusqueda" :disabled="editar">Buscar</button>
                <div class="modal fade" id="modalBusqueda" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Busqueda</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-12 col-sm-4 input-group mb-2">
                                    <select class="custom-select" v-model="criterio">
                                        <option value="" disabled>Buscar por</option>
                                        <option value="code">Codigo</option>
                                        <option value="name">Nombre</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 input-group mb-2">
                                    <input type="text" class="form-control" v-model="buscar" @keyup.enter="listarProductos(buscar,criterio)" placeholder="Valor a buscar">
                                </div>
                                <button class="btn btn-primary mb-2" type="button" @click="listarProductos(buscar,criterio)">Enviar</button>
                                <table class="table mb-3 table-bordered">
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
                                        <tr v-for="product in arrayProductos" :key="product.id">
                                            <td v-text="product.code"></td>
                                            <td v-text="product.name"></td>
                                            <td v-text="product.sizeName"></td>
                                            <td v-text="product.stock"></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary" @click="enviarCodigo(product.code)">Seleccionar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Busqueda -->
            <div class="col-12 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Cantidad</div>
                </div>
                <input type="number" class="form-control" placeholder="Cantidad" v-model="quantity">
            </div>
        </div>
        <!-- Inicio Informacion Extra -->
        <div class="card mb-3">
            <div class="card-header">Informacion Extra</div>
            <div class="card-body">
                    <div class="col-12 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Nombre</div>
                        </div>
                        <input type="text" class="form-control" disabled v-model="nombre">
                    </div>
                    <div class="col-12 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Unidad</div>
                        </div>
                        <input type="text" class="form-control" disabled v-model="unidad">
                    </div>
                    <div class="col-12 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Descripcion</div>
                        </div>
                        <textarea class="form-control" rows="3" disabled v-model="descripcion"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary mb-2" v-if="editar == false" @click="agregarTabla()" :disabled="!confirmado">Agregar<i class="fas fa-chevron-right"></i></button>
                        <button type="button" class="btn btn-primary mb-2" v-if="editar == true" @click="agregarTabla()">Editar<i class="fas fa-chevron-right"></i></button>
                        <button type="button" class="btn btn-secondary mb-2" v-if="editar == true" @click="limpiarTabla()">Cancelar<i class="fas fa-chevron-right"></i></button>
                    </div>
            </div>
        </div>
        <!-- Fin Informacion Extra -->
        <!-- Inicio de tabla de Productos -->
        <table class="table mb-3 table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(lista, index) in arrayLista" :key="lista.id">
                    <th scope="row" v-text="index + 1"></th>
                    <td v-text="lista.code"></td>
                    <td v-text="lista.name"></td>
                    <td v-text="lista.description"></td>
                    <td v-text="lista.quantity"></td>
                    <td v-text="lista.sizeName"></td>
                    <td>
                        <button type="button" class="btn btn-outline-info" @click="editarItem(lista)">Editar</button>
                        <button type="button" class="btn btn-outline-danger" @click="eliminarItem(lista)">Eliminar</button>
                    </td>

                </tr>
            </tbody>
        </table>
        <!-- Fin de Tabla de Productos -->
        <tipo-ingreso @cargarData="enviarTodo"></tipo-ingreso>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                criterio:'',
                buscar:'',
                arrayProductos:[],
                codeProduct:'',
                arrayLista: [],
                quantity:0,
                existe:false,
                consolidado: {},
                confirmado: false,
                editar: false,
                id:0,
                codigo:'',
                nombre:'',
                unidad:'',
                descripcion:'',
                stock:0,
            }
        },
        mounted() {
            console.log('OPCION MOVIMIENTO')
        },
        methods:{
            listarProductos(buscar, criterio){
                let me = this;
                let url = '/producto?buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    me.arrayProductos=respuesta.products.data;
                })
                .catch(function(error){
                    console.log(error.response)
                });
            },
            enviarCodigo(code){
                let me = this;
                let url = '/producto?buscar='+code+'&criterio=code';
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    if(!respuesta.products.data[0]) return console.log('No se encontraron coincidencias con el codigo')
                    me.id = respuesta.products.data[0].id;
                    me.codigo = respuesta.products.data[0].code;
                    me.nombre = respuesta.products.data[0].name;
                    me.descripcion = respuesta.products.data[0].description;
                    me.unidad = respuesta.products.data[0].sizeName;
                    me.stock = respuesta.products.data[0].stock;
                    me.confirmado = true;
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cerrarModal(){
                let closeModal = document.getElementById('closeModal');
                closeModal.click();
            },
            agregarTabla(){
                this.validarExistencia(this.id)
                if(this.quantity <= 0) return console.log('Ingrese una cantidad valida');
                if(this.quantity > this.stock) return console.log('No existe stock suficiente para', this.codigo)
                if(this.existe == true) return console.log('Registro duplicado');
                let item = [];
                item.id = this.id;
                item.code = this.codigo;
                item.name = this.nombre;
                item.description = this.descripcion;
                item.sizeName = this.unidad
                item.quantity = parseInt(this.quantity,10);
                this.arrayLista.push(item);
                this.limpiarTabla();
            },
            editarItem(lista){
                console.log('se presiono editar', lista.code);
                this.codeProduct = lista.code;
                this.quantity = lista.quantity;
                this.editar = true;
                this.eliminarItem(lista);
                this.enviarCodigo(this.codeProduct);
            },
            eliminarItem(lista){
                console.log('Se elimino', lista.code);
                let pos = this.arrayLista.indexOf(lista);
                let eliminado = this.arrayLista.splice(pos, 1);
            },
            validarExistencia(id){
                this.existe = false;
                this.arrayLista.forEach(element => {
                    if(element.id === id){
                        this.existe = true;
                    }
                });
            },
            enviarTodo(value){
                if(this.arrayLista.length == 0 ){
                    return console.log('No hay productos en el movimiento');
                }
                if(value['movement_type_id'] === undefined || value['movement_type_id'] === "" || value['movement_type_id'] === 0){
                    return console.log('No existe tipo de movimiento');
                }
                this.consolidado['movement_type_id']=value['movement_type_id'];
                if(value['document_type_id'] === undefined || value['document_type_id'] === "" || value['document_type_id'] === 0){
                    return console.log('No existe tipo de documento');
                }
                this.consolidado['document_type_id'] = value['document_type_id']
                if(value['document_number'] === undefined || value['document_number'] === ""){
                    return console.log('No existe documento');
                }
                this.consolidado['document_number'] = value['document_number'];
                if(value['date'] === undefined || value['date'] === "" ){
                    return console.log('No existe fecha')
                }
                this.consolidado['date'] = value['date'];
                this.consolidado['buyer'] = (value['buyer'] || null);
                this.consolidado['authorizer'] = (value['authorizer'] || null);
                this.consolidado['deliverer'] = (value['deliverer'] || null);
                this.consolidado['reciever'] = (value['reciever'] || null);
                this.consolidado['courier_descripcion'] = (value['courier_descripcion'] || null);
                this.consolidado['origin'] = (value['origin'] || null);
                this.consolidado['destination'] = (value['destination'] || null);
                this.consolidado['products'] = {}
                this.arrayLista.forEach((element, index) => {
                    this.consolidado['products'][index]= {'id': element.id, 'code': element.code, 'quantity': element.quantity};
                });
                // this.consolidado['products'] = {0:{'name': this.arrayLista[0].name},
                //                                 1:{'code': this.arrayLista[0].code}};
                let url = '/movimiento';
                console.log('Consolidado', this.consolidado);
                console.log('this.arrayLista', this.arrayLista);

                axios.post(url, this.consolidado).then(function (response) {
                    console.log('Enviado con exito')
                    console.log(response.data)
                    // console.log(response.data.products)
                    // console.log(response.data.requests)

                })
                .catch( function (error) {
                    console.log(error.response)
                })
                this.limpiarTabla();
                this.arrayLista = [];
            },
            limpiarTabla(){
                this.codeProduct = '';
                this.editar = false;
                this.id = 0;
                this.codigo = '';
                this.nombre = '';
                this.unidad = '';
                this.descripcion = '';
                this.quantity = 0;
                this.confirmado = false;
                this.stock = 0;
            }
        }
    }
</script>
