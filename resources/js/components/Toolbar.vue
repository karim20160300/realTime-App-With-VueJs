<template>
<div id="app">
    <v-card>
      <v-toolbar dense>
       
          
        <v-toolbar-title>Forum</v-toolbar-title>
  
        <v-spacer></v-spacer>
        <div
          v-if="loged"
        >
        <app-notification></app-notification>
        </div>
        
        <div>
        <router-link 
        v-for="item in items"
        :key="item.title"
        :to="item.to"
        v-if="item.show">
          <v-btn class="ml-4 mt-2">{{item.title}}</v-btn>  
         </router-link>
        
        </div>
      </v-toolbar>
    </v-card>
</div>
</template>
<script>
import AppNotification from './AppNotification'
    export default {
      components:{AppNotification},
        data(){
          return{
            items: [
              {title: 'Forum', to:'/forum', show:true},
              {title: 'Ask Questions', to:'/ask', show: User.loggedIn()},
              {title: 'Categories', to:'/categories', show: User.loggedIn()},
              {title: 'LogIn', to:'/login', show: !User.loggedIn()},
              {title: 'LogOut', to:'/logout', show: User.loggedIn()},
            ],
            loged:false,
          }
        },
        created(){
          EventBus.$on('logout', () => {
            User.logout()
          })

          this.check()
        },
        methods:{
          check(){
            if(User.loggedIn()){
            this.loged= true
          }
          }
        }
    }
</script>

<style lang="scss" scoped>

</style>