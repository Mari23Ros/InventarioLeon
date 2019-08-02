<template>
    <div class="form-row">
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Boleta / Factura</div>
            </div>
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Nro" v-model="boletaFactura" @blur="enviarData()">
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Fecha</div>
            </div>
            <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="" v-model="fecha" @blur="enviarData()">
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Comprado por</div>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="compradoPor" @blur="enviarData()">
                <option selected value="null" disabled>Choose...</option>
                <option v-for="user in arrayUsers" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                arrayWarehouses: [],
                arrayUsers: [],
                boletaFactura: '',
                fecha: '',
                compradoPor:null,
                origen:0,
                destino:0,
                info:[],
            }
        },
        mounted() {
            this.$nextTick(function () {
                console.log('Ingreso de Compra montado');
                this.listarSelects();
                this.obtenerAlmacenes();
            })
        },
        methods: {
            listarSelects(){
                let me = this;
                let url2 = '/producto/getWarehouseUsers';
                axios.get(url2).then(function (response) {
                    let respuesta = response.data;
                    me.arrayWarehouses=respuesta.warehouses;
                    me.arrayUsers=respuesta.users;
                    // console.log('montado');
                    // console.log(response.data.users);
                    // console.log(me.arrayUsers);
                })
                .catch(function(error){
                    console.log(error.response)
                });
            },
            obtenerAlmacenes(){
                let me = this;
                let url = '/warehouses';
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    me.destino = respuesta.destinations.data[0].id
                })
                .catch(function(error){
                    console.log(error.response)
                });
            },
            enviarData(event){
                this.info['document_type_id'] = 1
                this.info['document_number'] = this.boletaFactura;
                this.info['origin']= null;
                this.info['destination']=this.destino;
                this.info['date'] = this.fecha;
                this.info['buyer'] = this.compradoPor;
                this.$emit('cargarData', this.info );
            }
        }
    }
</script>
