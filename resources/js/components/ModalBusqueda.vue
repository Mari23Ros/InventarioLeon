<template>
    <div class="col-12 col-sm-2 order-1 order-sm-0">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Buscar
        </button>

    <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Busqueda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <label>Buscar por</label>
                            <select v-model="criterio">
                                <option value="code">Codigo</option>
                                <option value="name">Nombre</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarProductos(buscar,criterio)">
                            <button type="submit" @click="listarProductos(buscar,criterio)">Enviar</button>
                        <table>
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in arrayProductos" :key="product.id">
                                    <td v-text="product.code"></td>
                                    <td v-text="product.name"></td>
                                    <td v-text="product.stock"></td>
                                    <td>
                                        <button type="button" @click="enviarData(product)">Seleccionar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                criterio:'',
                buscar:'',
                arrayProductos:[],
            }
        },
        mounted() {
            console.log('Component mounted.')
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
                    console.log(error)
                });
            },
            enviarData(product){
                let me = this;
                let productID = product.id;
                console.log(productID);
                let url = '/movimiento/rellenar?id='+productID;
                axios.get(url).then(function (response) {
                    me.cerrarModal();
                    let respuesta = response.data;
                    console.log(respuesta.item.data);
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cerrarModal(){
                let closeModal = document.getElementById('closeModal');
                closeModal.click();
            }
        }
    }
</script>
