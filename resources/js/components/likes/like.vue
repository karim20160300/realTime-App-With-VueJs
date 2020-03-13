<template>
     <v-badge
        :content="totalCount"
        :value="totalCount"
        color="red"
        overlap
      >
        <v-icon color="pink" @click="likeIt" large>{{ icon }}</v-icon>
      </v-badge>
</template>

<script>
    export default {
        props:['reply'],
        data(){
            return {
                count:0,
                totalCount:0,
                icon:'mdi-heart-outline'
            }
        },
        created(){
            this.totalCount = this.getReplyLikes();
            this.iconChange();
            Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
                if(e.id == this.reply.id){
                    e.type == 1 ? this.totalCount ++ : this.totalCount--
                }
    });
        },
        methods:{
            likeIt(){
                if(this.reply.liked == 1){
                    axios.delete(`/api/like/${this.reply.id}`)
                    .then(res => {
                        if(this.totalCount > 0){
                            this.totalCount --
                        }
                        this.icon = 'mdi-heart-outline'
                        this.reply.liked = 0
                    })
                }else if(this.reply.liked == 0){
                    axios.post(`/api/like/${this.reply.id}`)
                    .then(res => {
                            this.totalCount ++
                            this.icon = 'mdi-heart'
                            this.reply.liked = 1
                    })
                }
            },
            getReplyLikes(){
                return this.reply.likesCount;
            },
            iconChange(){
                if(this.reply.liked){
                    this.icon = 'mdi-heart'
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>