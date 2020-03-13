<template>
    <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field
        v-model="form.name"
        label="Category Name"
        type="text"
        required
      ></v-text-field>
      
       
       <v-btn class="mr-4" v-if="editSlug"
       color="pink"
       type="submit"      
       >Update Category</v-btn>
      
      <v-btn class="mr-4" v-else
       color="green"
       type="submit"      
       >Create Category</v-btn>
      
    </v-form>
    <div style="margin:20px"></div>
    <v-card mt-2>
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
</v-container>
</template>

<script>
import CategoryList from '../forum/CategoryList'
    export default {
        components:{CategoryList},
        data(){
            return{
                form:{
                    name:null
                },
                categories:{},
                editSlug:null
            }
            
        },
        created(){
            
            this.getCategories();
            this.listen();
        },
        methods:{
            listen(){
                EventBus.$on('editCategory', (index)=>{
                    this.form.name = this.categories[index].name
                    this.editSlug = this.categories[index].slug
                    this.categories.splice(index,1)
                })
            },
            submit(){
                this.editSlug ? this.update() : this.create()
            },
            create(){
                axios.post('/api/category', this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.name = null;
                })
            },
            update(){
                axios.patch(`/api/category/${this.editSlug}`, this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.name = null
                    this.editSlug=null
                })
                
            },
            getCategories(){
                axios.get('api/category')
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