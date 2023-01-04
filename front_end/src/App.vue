<template>
  <div id="app">
     <NavBar></NavBar>
    <!-- 
    <nav>
      <router-link to="/">Inicio</router-link> |
      <router-link to="/listar">Nuevo</router-link>
    </nav>
    --> 
    <div class="container-fluid">
      <router-view/>
    </div>
  </div>
</template>

<script>
  import NavBar from './components/layout/NavBar'
  export default {
    name: 'app',
     components: {
      NavBar
    }
  }
</script>