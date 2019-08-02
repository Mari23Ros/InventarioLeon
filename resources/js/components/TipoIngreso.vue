<template>
    <div class="mb-3">
        <div class="form-row mb-3">
            <div class="input-group">
                <div class="col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="condicion" id="condicionCompra" @click="condicion = 1" value="1">
                        <label for="condicionCompra"> &nbsp;Ingreso - Compra</label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="condicion" id="condicionRetornoObra" @click="condicion = 2" value="2">
                        <label for="condicionRetornoObra">&nbsp;Ingreso - Retorno de Obra</label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="condicion" id="condicionSalidaEntreAlmacences" @click="condicion = 3" value="3">
                        <label for="condicionSalidaEntreAlmacences">&nbsp;Salida - entre almacenes</label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="condicion" id="condicionSalidaUsoObra" @click="condicion = 4" value="4">
                        <label for="condicionSalidaUsoObra">&nbsp;Salida - Uso en Obra</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <template v-if="condicion == 1">
                    <ingreso-compra @cargarData="cargarInfo"></ingreso-compra>
                </template>
                <template v-else-if="condicion == 2">
                    <ingreso-retorno-obra @cargarData="cargarInfo"></ingreso-retorno-obra>
                </template>
                <template v-else-if="condicion == 3">
                    <ingreso-retorno-obra @cargarData="cargarInfo"></ingreso-retorno-obra>
                </template>
                <template v-else-if="condicion == 4">
                    <salida-uso-obra @cargarData="cargarInfo"></salida-uso-obra>
                </template>
                <template v-else>
                    <p>Elija una opcion</p>
                </template>

            </div>
        </div>
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-primary btn-lg btn-block" @click="enviarData()">Registrar</button>
            <button type="button" class="btn btn-secondary btn-lg btn-block">Cancelar</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                condicion:0 ,
                informacion: [],
            }
        },
        mounted() {
            console.log('Cargado TipoIngreso.vue')
        },
        methods: {
            cargarInfo(value){
                this.informacion = value;
                console.log('Se cargo la informacion', this.informacion);
            },
            enviarData(event){
                this.informacion['movement_type_id'] = this.condicion
                console.log(this.informacion)
                this.$emit('cargarData', this.informacion);
            }
        }
    }
</script>
<style scoped>
    h1{
      display: block;
      width : 100px;
      height: 100px;
    }
</style>
