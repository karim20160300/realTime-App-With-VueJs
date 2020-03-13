<template>
    <div class="mt-3">
      <v-card
        max-width="1500"
        class="mx-auto"
    >
    
          <v-card-title>
              <div class="headline red--text">{{reply.user}}</div>
              <div class="ml-2">said {{reply.created_at}}</div>
              <v-spacer></v-spacer>
              <div v-if="!editReply">
                  <v-card-actions v-if="adminChecker||replyOwner">
              <v-btn small icon @click="edit">
                  <v-icon color="green">edit</v-icon>
              </v-btn>

              <v-btn small icon @click="destroy(index)">
                  <v-icon color="red">delete</v-icon>
              </v-btn>
             
          </v-card-actions>
              </div>
              <div class="ml-4"><like :reply= reply></like></div>
          </v-card-title>
          <v-divider></v-divider>
        <edit-reply v-if="editReply"
        :reply = reply
        :replyBeforeEditing = replyBeforeEditing
        ></edit-reply>
          <v-card-text class="headline font-weight-black text--black" v-else v-html="reply.reply"></v-card-text>
      </v-card>
      <br>
    </div>
</template>

<script>
import EditReply from '../reply/EditReply'
import Like from '../likes/like'
    export default {
        components:{EditReply, Like},
        data(){
            return{
                replyOwner:false,
                adminChecker:false,
                editReply:false,
                replyBeforeEditing:''
            }
        },
        created(){
            this.checkadmin();
            this.checkOwn();
            this.listen();
        },
        props:['reply','index','replies'],
        methods:{
            destroy(index){
                axios.delete(`/api/question/${this.reply.questionSlug}/reply/${this.reply.id}`)
                .then(res => {
                    this.replies.splice(index,1)
                    EventBus.$emit('deleteReply')
                })
            },
            checkadmin(){
                if(User.admin()){
                    this.adminChecker = true;
                }
            },
            checkOwn(){
                if(User.own(this.reply.user_id)){
                    this.replyOwner = true
                }
            },
            edit(){
                this.editReply = true;
                this.replyBeforeEditing = this.reply.reply;
            },
            listen(){
                EventBus.$on('cancelEditing', ()=>{
                    this.reply.reply = this.replyBeforeEditing;
                    this.editReply = false;
                }),
                EventBus.$on('finisEditingReply', ()=>{
                    this.editReply = false;
                })
            }

        }
    }
</script>

<style lang="scss" scoped>

</style>