<template>
    <div class="card mt-3 col-sm-8 " style="margin:auto;">
        <div class="card-header bg-primary text-white">
            <h5 class="card-text">Editar Empleado</h5>
        </div>
        <div class="card-body">
            <form >
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.nombres" :class="{'is-invalid':v$.empleado.nombres.$errors.length>0}" class="form-control" type="text" placeholder="Nombres Completos" maxlength="30" @blur="v$.empleado.nombres.$touch()">
                        <div v-if="v$.empleado.nombres.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.nombres.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Apellido Paterno</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.ape_paterno" :class="{'is-invalid':v$.empleado.ape_paterno.$errors.length>0}" type="text" class="form-control" placeholder="Apellido Paterno" maxlength="30" @blur="v$.empleado.ape_paterno.$touch()">
                        <div v-if="v$.empleado.ape_paterno.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.ape_paterno.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Apellido Materno</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.ape_materno" :class="{'is-invalid':v$.empleado.ape_materno.$errors.length>0}" type="text" class="form-control" placeholder="Apellido Materno" maxlength="30" @blur="v$.empleado.ape_materno.$touch()">
                        <div v-if="v$.empleado.ape_materno.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.ape_materno.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Genero</label>
                    <div class="col-sm-9">
                        <select v-model="empleado.genero" class="form-control" 
                        :class="{'is-invalid':v$.empleado.genero.$errors.length>0}" @blur="v$.empleado.genero.$touch()">
                            <option value="">:::Seleccione:::</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <div v-if="v$.empleado.genero.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.genero.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Fecha Nacimiento</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.fecha_nacimiento" type="date" class="form-control"
                        :class="{'is-invalid':v$.empleado.fecha_nacimiento.$errors.length>0}" @blur="v$.empleado.fecha_nacimiento.$touch()"
                        >
                        <div v-if="v$.empleado.fecha_nacimiento.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.fecha_nacimiento.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Correo</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.correo" type="text" class="form-control" placeholder="Correo Electronico" maxlength="40"
                        :class="{'is-invalid':v$.empleado.correo.$errors.length>0}" @blur="v$.empleado.correo.$touch()">
                        
                        <div v-if="v$.empleado.correo.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.correo.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Sueldo</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.sueldo" type="number" step="0.1" class="form-control" placeholder="Sueldo" min="0"
                        :class="{'is-invalid':v$.empleado.sueldo.$errors.length>0}" @blur="v$.empleado.sueldo.$touch()">

                        <div v-if="v$.empleado.sueldo.$errors.length" style="color:red;">
                            <div>{{ v$.empleado.sueldo.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <button @click="fnEditar()" :disabled="v$.$invalid" type="button" class="btn btn-primary"
                    style="margin-right: 5px;">Guardar</button>
                <button @click=fnLimpiar() type="button" class="btn btn-danger">Nuevo</button>
            </form>
        </div>
    </div>
</template>

<script>
    import useValidate from '@vuelidate/core'
    import { required,minLength,email,minValue, helpers } from '@vuelidate/validators';
    import { config } from "@/assets/js/generales.js";
    import * as valid from "@/assets/js/validaciones.js";
    import * as toast from "@/assets/services/AlertaService.js";
 
    export default {
        name: 'EditarEmp',
        data(){
            return{
                v$ : useValidate(),
                urlBase: config.urlBase + '/EmpleadoController.php?',
                empleado:{}
            }
        },
        created: function(){
            this.fnCrear();
            this.fnCargarDatos();
        },
        validations(){
            return {
                empleado:{
                    nombres: { 
                        required: helpers.withMessage('El campo es requerido.', required),
                        soloLetras: helpers.withMessage('Debe contener solo letras.', valid.soloLetras),
                        minLength: helpers.withMessage(({$params})=>`Debe tener como mínimo ${$params.min} caracteres.`,minLength(4))
                    },
                    ape_paterno:{
                        required: helpers.withMessage('El campo es requerido.', required),
                        soloLetras: helpers.withMessage('Debe contener solo letras.', valid.soloLetras),
                    },
                    ape_materno:{
                        required: helpers.withMessage('El campo es requerido.', required),
                        soloLetras: helpers.withMessage('Debe contener solo letras.', valid.soloLetras),
                    },
                    genero:{
                        required: helpers.withMessage('Por favor seleccione un género.', required),
                    },
                    fecha_nacimiento:{
                        required: helpers.withMessage('El campo es requerido.', required),
                        formatoFecha: helpers.withMessage('Formato no válido: yyyy-MM-dd.', valid.formatoFecha),
                    },
                    correo:{
                        required: helpers.withMessage('El campo es requerido.', required),
                        email: helpers.withMessage('Formato no válido.', email),
                    },
                    sueldo:{
                        required: helpers.withMessage('El campo es requerido.', required),
                        minValue: helpers.withMessage('El minimo valor es 0.', minValue(0)),
                    }
                }
            }
        },
        methods:{
            fnCargarDatos(){
                var url = this.urlBase + 'accion=buscar';
                var params ={
                    'id': this.$route.params.id
                };

                fetch(url, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(params)
                })
                .then(res => res.json())
                .then(data => {
                    this.empleado = data;
                })
                .catch(error => {
                    console.dir(error.message);
                });
            },
            fnEditar(){
                this.v$.$validate();
             
                var url = this.urlBase + 'accion=editar';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.empleado)
                })
                .then(res => res.json())
                .then(data => {
                    if(data.msg == "OK"){
                        toast.success('Los datos se editaron de forma correcta.');
                        this.$router.push('/');
                    }else{
                        toast.warning(data.msg);
                    }
                })
                .catch(error => {
                    console.dir(error.message);
                });
            },
            fnLimpiar(){
                this.v$.$validate();
                this.v$.$reset();
                this.fnCrear();
            },
            fnCrear(){
                this.empleado.nombres ='';
                this.empleado.ape_paterno='';
                this.empleado.ape_materno='';
                this.empleado.genero='';
                this.empleado.fecha_nacimiento='';
                this.empleado.correo='';
                this.empleado.sueldo=0;
            }
        }
    }
</script>