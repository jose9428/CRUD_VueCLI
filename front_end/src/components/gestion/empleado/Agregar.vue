<template>
    <div class="card mt-3 col-sm-8 " style="margin:auto;">
        <div class="card-header bg-primary text-white">
            <h5 class="card-text">Nuevo Empleado</h5>
        </div>
        <div class="card-body">
            <form >
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.nombres" :class="{'is-invalid':v$.nombres.$errors.length>0}" class="form-control" type="text" placeholder="Nombres Completos" maxlength="30" @blur="v$.nombres.$touch()">
                        <div v-if="v$.nombres.$errors.length" style="color:red;">
                            <div>{{ v$.nombres.$errors[0].$message}}</div>
                            <!--
                            <div v-for="(error, index) of v$.nombres.$errors" :key="index">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Apellido Paterno</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.ape_paterno" :class="{'is-invalid':v$.ape_paterno.$errors.length>0}" type="text" class="form-control" placeholder="Apellido Paterno" maxlength="30" @blur="v$.ape_paterno.$touch()">
                        <div v-if="v$.ape_paterno.$errors.length" style="color:red;">
                            <div>{{ v$.ape_paterno.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Apellido Materno</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.ape_materno" :class="{'is-invalid':v$.ape_materno.$errors.length>0}" type="text" class="form-control" placeholder="Apellido Materno" maxlength="30" @blur="v$.ape_materno.$touch()">
                        <div v-if="v$.ape_materno.$errors.length" style="color:red;">
                            <div>{{ v$.ape_materno.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Genero</label>
                    <div class="col-sm-9">
                        <select v-model="empleado.genero" class="form-control" 
                        :class="{'is-invalid':v$.genero.$errors.length>0}" @blur="v$.genero.$touch()">
                            <option value="">:::Seleccione:::</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <div v-if="v$.genero.$errors.length" style="color:red;">
                            <div>{{ v$.genero.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Fecha Nacimiento</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.fecha_nacimiento" type="date" class="form-control"
                        :class="{'is-invalid':v$.fecha_nacimiento.$errors.length>0}" @blur="v$.fecha_nacimiento.$touch()"
                        >
                        <div v-if="v$.fecha_nacimiento.$errors.length" style="color:red;">
                            <div>{{ v$.fecha_nacimiento.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Correo</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.correo" type="text" class="form-control" placeholder="Correo Electronico" maxlength="40"
                        :class="{'is-invalid':v$.correo.$errors.length>0}" @blur="v$.correo.$touch()">
                        
                        <div v-if="v$.correo.$errors.length" style="color:red;">
                            <div>{{ v$.correo.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Sueldo</label>
                    <div class="col-sm-9">
                        <input v-model="empleado.sueldo" type="number" step="0.1" class="form-control" placeholder="Sueldo" min="0"
                        :class="{'is-invalid':v$.sueldo.$errors.length>0}" @blur="v$.sueldo.$touch()">

                        <div v-if="v$.sueldo.$errors.length" style="color:red;">
                            <div>{{ v$.sueldo.$errors[0].$message}}</div>
                        </div>
                    </div>
                </div>

                <button @click="fnAgregar()" :disabled="v$.$invalid" type="button" class="btn btn-primary"
                    style="margin-right: 5px;">Guardar</button>
                <button @click=fnLimpiar() type="reset" class="btn btn-danger">Nuevo</button>
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
    import { reactive ,computed } from 'vue';
    
    export default {
        name: 'AgregarEmp',
        setup(){
            const empleado = reactive({
                nombres:'',
                ape_paterno:'',
                ape_materno:'',
                genero:'',
                fecha_nacimiento:'',
                correo:'',
                sueldo:0
            })

            const rules = computed(() =>{
                return {
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
            })

            const v$ = useValidate(rules ,empleado);

            return {
                empleado,v$
            }
        },
        data(){
            return{
                urlBase: config.urlBase + '/EmpleadoController.php?'
            }
        },
        methods:{
            fnAgregar(){
                this.v$.$validate();

                var url = this.urlBase + 'accion=guardar';

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
                        toast.success('Los datos se guardaron de forma correcta.');
                        this.$router.push('/');
                       // this.$router.push({path: '/'});
                    }else{
                        toast.warning(data.msg);
                    }
                })
                .catch(error => {
                    console.dir(error.message);
                });
            },
            fnLimpiar(){
                this.v$.$reset();
            }
        }
    }
</script>

<style scoped>
    .valid input {
    border: 1px solid green;
    }

    .error {
        border: 1px solid red;
    }
</style>