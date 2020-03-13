<template>
    <div>
    <v-card>
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                   {{question.title}}
                </h3>
                <span class="red--text">{{question.user}}</span>
                <span class="grey--text">
                    {{question.created_at}}</span>
            </div>
            <v-spacer></v-spacer>
            <create-new-reply
                :replies = question.replies
                :question= question
            >
            </create-new-reply>
            <v-btn color="teal" dark>{{replyCount}} Replies</v-btn>
        </v-card-title>
        <v-card-text v-html="question.body"></v-card-text>
        <v-card-actions v-if="own">
            <v-btn icon small @click="edit">
                <v-icon color="green">edit</v-icon>
            </v-btn>
            <v-btn icon small @click="destroy">
                <v-icon color="red">delete</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
    <br>
    <question-replies
    :replies = question.replies
    ></question-replies>
    </div>
</template>

<script>
import CreateNewReply from '../reply/CreateNewReply'
import QuestionReplies from '../reply/QuestionReplies'
    export default {
        components:{QuestionReplies,CreateNewReply},
        props:['question'],
        data(){
            return{
                // own: User.own(this.question.user_id),
                // replyCount:this.question.replies_count
                own: false,
                replyCount: 0
            }
        },
        created(){
            this.findReplyCount()
            this.isOwn()
            EventBus.$on('deleteReply', ()=>{
                if(this.replyCount > 0){
                    this.replyCount -=1
                }
            }),
            EventBus.$on('newReplyAdded', ()=>{
                this.replyCount +=1
            })

            Echo.private('App.User.' + User.id())
            .notification((notification) => {
                this.replyCount++
             });
        },
        methods:{
            destroy(){
                axios.delete(`/api/question/${this.question.slug}`)
                .then(res => this.$router.push('/forum'))
                .catch(error => console.log(error.response.data))
            },
            edit(){
                EventBus.$emit('startEditing');
            },
            isOwn(){
                 if(User.own(this.question.user_id))
                 {
                     this.own = true;
                 }
            },
            findReplyCount(){
                 if(this.question.replies_count !== null)
                 {
                     this.replyCount = this.question.replies_count;
                 }
            }

        }
    }
</script>

<style lang="scss" scoped>

</style>