<template>
    <div>
        <vue-simplemde v-model="reply.reply" ref="markdownEditor" />
        <v-card-actions>
              <v-btn small icon @click="update">
                  <v-icon color="blue">update</v-icon>
              </v-btn>

              <v-btn small icon @click="cancel">
                  <v-icon color="black">cancel</v-icon>
              </v-btn>
          </v-card-actions>
    </div>
</template>

<script>
    export default {
        props:['reply'],
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing')
            },
            update(){
                axios.patch(`/api/question/${this.reply.questionSlug}/reply/${this.reply.id}`, {body:this.reply.reply})
                .then(res => {
                    EventBus.$emit('finisEditingReply')
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>