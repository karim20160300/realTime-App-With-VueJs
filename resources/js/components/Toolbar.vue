<template>
<div id="app">
    <v-card>
      <v-toolbar dense>
       
          
        <v-toolbar-title>Fourm</v-toolbar-title>
  
        <v-spacer></v-spacer>
  
        <div>
        <router-link to="/fourm">Fourm</router-link>
        <router-link to="/ask">Ask Questions</router-link>
        <router-link to="/categories">Categories</router-link>
        <router-link to="/login">LogIn</router-link>
        </div>
      </v-toolbar>
    </v-card>
</div>
</template>
<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>