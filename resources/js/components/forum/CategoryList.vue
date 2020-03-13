<template>
<v-list v-if="show">
    <div v-for="(category,index) in categories" :key="category.id">
        <v-list-item>
        <v-list-item-icon>
          <v-icon color="pink">mdi-star</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title > {{ category.name }}
          </v-list-item-title>
        </v-list-item-content>
        <v-list-item-action v-if="windowLocation">
          <v-btn icon @click="edit(index)" v-if="adminChecker">
            <v-icon color="green">edit</v-icon>
          </v-btn>
        </v-list-item-action>
        <v-list-item-action v-if="windowLocation">
            <v-btn icon @click="destroy(category.slug,index)" v-if="adminChecker">
            <v-icon color="red">delete</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
      <v-divider></v-divider>
    </div>
      </v-list>
</template>

<script>
    export default {
        data(){
            return{
                show:true,
                adminChecker:false,
                windowLocation:null,
            }
        },
        created(){
            this.listen()
            this.admin()
            this.windwo()
        },
        props:['categories'],
        methods:{
            listen(){
                EventBus.$on('list', ()=>{
                    if(this.show == false){
                        this.show = true
                    }else{
                        this.show = false
                    }
                })
            },
            destroy(slug,index){
                axios.delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index,1))
            },
            edit(index){
                EventBus.$emit('editCategory',index);
            },
            admin(){
                if(User.loggedIn()){
                    this.adminChecker = User.admin()
                }
                
            },
            windwo(){
                if(window.location.href === 'http://localhost:8000/forum'){
                    this.windowLocation = false
                }else{
                    this.windowLocation = true
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>