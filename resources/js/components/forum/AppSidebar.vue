<template>
   <v-card
    max-width="500"
    class="mx-auto"
  >
    <v-toolbar
      color="indigo"
      dark
    >
    
    <v-app-bar-nav-icon @click="showList"></v-app-bar-nav-icon>
      <v-toolbar-title>Categories</v-toolbar-title>

      <v-spacer></v-spacer>

    </v-toolbar>
    <category-list :categories = categories></category-list>
  </v-card>
</template>

<script>
import CategoryList from './CategoryList'
    export default {
        components:{CategoryList},
        data(){
            return{
                categories:{}
            }
        },
        created(){
            this.getCategories()
        },
        methods:{
            getCategories(){
                axios.get('/api/category')
                .then(res => this.categories = res.data.data)
            },
            showList(){
                EventBus.$emit('list');
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>