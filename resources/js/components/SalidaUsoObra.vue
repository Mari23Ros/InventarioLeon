<template>
    <div class="form-row">
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Numero de Guia</div>
            </div>
            <input type="text" class="form-control" placeholder="Nro" v-model="numeroGuia" @blur="enviarData()">
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Fecha</div>
            </div>
            <input type="date" class="form-control" id="inlineFormInputGroup" v-model="fecha" @blur="enviarData()">
        </div>
        <div class="col-12 col-sm-12 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Almacen</div>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="origen" @blur="enviarData()">
                <option selected disabled value="null">Choose...</option>
                <option v-for="warehouse in arrayWarehouses" :key="warehouse.id" :value="warehouse.id">{{ warehouse.name }}</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Autorizado por</div>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="autorizadoPor" @blur="enviarData()">
                <option selected disabled value="null">Choose...</option>
                <option v-for="user in arrayUsers" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Entregado por</div>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="entregadoPor" @blur="enviarData()">
                <option selected disabled value="null">Choose...</option>
                <option v-for="user in arrayUsers" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
        </div>
        <div class="col-12 col-sm-12 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Descripcion de transporte</div>
            </div>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="descripcionTransporte" @blur="enviarData()"></textarea>
        </div>
        <div class="col-12 col-sm-6 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Recepcionado por</div>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="recepcionadoPor" @blur="enviarData()">
                <option selected disabled value="null">Choose...</option>
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
                numeroGuia:'',
                fecha:'',
                origen:null,
                autorizadoPor:null,
                entregadoPor:null,
                descripcionTransporte:'',
                recepcionadoPor:null,
                info: [],
            }
        },
        mounted() {
            this.$nextTick(function () {
                console.log('Ingreso de Obra montado');
                this.listarSelects();
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
            enviarData(event){
                this.info['document_type_id'] = 2;
                this.info['document_number'] = this.numeroGuia;
                this.info['date'] = this.fecha;
                this.info['origin'] = this.origen;
                this.info['destination'] = null;
                this.info['authorizer'] = this.autorizadoPor;
                this.info['deliverer'] = this.entregadoPor;
                this.info['courier_description'] = this.descripcionTransporte;
                this.info['reciever'] = this.recepcionadoPor;
                this.$emit('cargarData', this.info);
            }
        }
    }
</script>
