import { createRouter, createWebHistory } from 'vue-router'
import ListarEmp from '../components/gestion/empleado/Listar.vue'
import AgregarEmp from '../components/gestion/empleado/Agregar.vue'
import EditarEmp from '../components/gestion/empleado/Editar.vue'

const routes = [
  {path: '/',name: 'Listar', component: ListarEmp},
  {path: '/nuevo',name: 'nuevo', component: AgregarEmp},
  {path: '/editar/:id',name: 'editar', component: EditarEmp},
  {path: '/:catchAll(.*)',redirect:'/'},
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
