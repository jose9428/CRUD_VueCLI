<template>
 <router-link to="/nuevo" class="btn btn-success mt-3" title="Nuevo">
    <i class="fa fa-plus-circle"></i> Nuevo
 </router-link>

  <div class="table-responsive">
    <table class="table table-bordered table-striped mt-3">
      <thead class=" bg-primary text-white">
        <tr>
          <th>Codigo</th>
          <th>Nombres</th>
          <th>Apellido</th>
          <th>Genero</th>
          <th>Fecha Nacimiento</th>
          <th>Fecha Ingreso</th>
          <th>Correo</th>
          <th>Sueldo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item of empleados" v-bind:key="item.id_empleado">
          <td>{{item.id_empleado}}</td>
          <td>{{item.nombres}}</td>
          <td>{{item.ape_paterno}} {{item.ape_materno}}</td>
          <td>{{item.genero =='F'?'Femenino':'Masculino'}}</td>
          <td>{{item.fecha_nacimiento}}</td>
          <td>{{item.fecha_registro}}</td>
          <td>{{item.correo}}</td>
          <td>{{item.sueldo}}</td>
          <td>
            <router-link :to="{name:'editar', params:{id: item.id_empleado}}" class="btn btn-info" title="Editar">
              <i class="fa fa-edit" aria-hidden="true"></i>
            </router-link>
            &nbsp;
            <button @click="fnEliminar(item)" class="btn btn-danger" title="Eliminar" >
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
          </td>
        </tr>

        <tr v-if="empleados.length == 0" >
          <td colspan="9" class="text-center">No se encontraron registros</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
import { config } from "@/assets/js/generales.js";
import * as toast from "@/assets/services/AlertaService.js";

export default {
  name: 'ListarEmp',
  data() {
    return {
      urlBase: config.urlBase + '/EmpleadoController.php?',
      empleados:[]
    }
  },
  created: function(){
    this.fnListarTodos();
  },
  methods:{
    fnListarTodos(){
      var url = this.urlBase + 'accion=listar';
      fetch(url)
      .then(res => res.json())
      .then(data => {
        this.empleados = data;
      })
      .catch(error => {
        console.dir(error.message);
      });  
    },
    fnEliminar(item){
      var datosEmp = item.nombres + ', ' + item.ape_paterno + ' '+ item.ape_materno;
      if(confirm('¿Está seguro que desea eliminar al empleado: '+ datosEmp +'?')){
        var url = this.urlBase + 'accion=eliminar';
        var params ={
          'id': item.id_empleado
        };
        fetch(url, {
            method: 'DELETE',
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(params)
        })
        .then(res => res.json())
        .then(data => {
            if(data.msg == "OK"){
              toast.success('Los datos se eliminaron de forma correcta.');
              this.fnListarTodos();
            }else{
              toast.warning(data.msg);
            }
        })
        .catch(error => {
          console.dir(error.message);
        });
      }
    }
  }
}
</script>
