<template>
    <div>
        <v-card
    max-width="1500"
    class="mx-auto"
  >
    <v-toolbar
      color="indigo"
      dark
    >
    
    <v-app-bar-nav-icon @click="showOrHideReplies"></v-app-bar-nav-icon>
      <v-toolbar-title>Replies</v-toolbar-title>

      <v-spacer></v-spacer>

    </v-toolbar>
  </v-card>
        <div v-for="(reply,index) in replies" :key="reply.id">
            <reply
                v-if="showOrHideRep"
                :reply = reply
                :index = index
                :replies = replies
            ></reply>
        </div>
    </div>
</template>

<script>
import Reply from './reply'
    export default {
        data(){
            return{
                showOrHideRep: true,
            }
        },
        components:{Reply},
        props:['replies'],
        methods:{
            showOrHideReplies(){
                if(this.showOrHideRep == false){
                    this.showOrHideRep = true;
                }else if(this.showOrHideRep == true){
                    this.showOrHideRep = false;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>