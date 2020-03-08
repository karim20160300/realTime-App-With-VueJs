<template>
<v-container>
    <v-form @submit.prevent="login">
      <v-text-field
        v-model="form.email"
        label="E-mail"
        type="email"
        required
      ></v-text-field>
      
      <v-text-field
        v-model="form.password"
        type="password"
        label="password"
        required
      ></v-text-field>
      
  
      <v-btn class="mr-4"
       color="green"
       type="submit"      
       >LogIn</v-btn>
      
      <router-link to="/signup">
      <v-btn color="blue">Sign Up</v-btn>
      </router-link>
      
    </v-form>
</v-container>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    email:null,
                    password:null
                }
            }
        },
        created(){
          if(User.loggedIn()){
            this.$router.push({name:'forum'});
          }
        },
        methods: {
            login(){
                User.login(this.form)
            }
        },
        
    }
</script>

<style lang="scss" scoped>

</style>