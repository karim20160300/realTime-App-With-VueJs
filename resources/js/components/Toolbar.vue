<template>
<div id="app">
    <v-card>
      <v-toolbar dense>
       
          
        <v-toolbar-title>Forum</v-toolbar-title>
  
        <v-spacer></v-spacer>
  
        <div>
        <router-link 
        v-for="item in items"
        :key="item.title"
        :to="item.to"
        v-if="item.show">
          <v-btn>{{item.title}}</v-btn>  
         </router-link>
        
        </div>
      </v-toolbar>
    </v-card>
</div>
</template>
<script>
    export default {
        data(){
          return{
            items: [
              {title: 'Forum', to:'/forum', show:true},
              {title: 'Ask Questions', to:'/ask', show: User.loggedIn()},
              {title: 'Categories', to:'/categories', show: User.loggedIn()},
              {title: 'LogIn', to:'/login', show: !User.loggedIn()},
              {title: 'LogOut', to:'/logout', show: User.loggedIn()},
            ]
          }
        },
        created(){
          EventBus.$on('logout', () => {
            User.logout()
          })
        }
    }
</script>

<style lang="scss" scoped>

</style>