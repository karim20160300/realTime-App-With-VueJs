<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      width="700"
    >
      <template v-slot:activator="{ on }">
        <v-btn
          color="blue lighten-2"
          dark
          v-on="on"
          class="mr-4"
        >
          Reply this question?
        </v-btn>
      </template>

      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Create Reply
        </v-card-title>

           <vue-simplemde v-model="body" ref="markdownEditor" />

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="createReply"
          >
            Create
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    export default {
        props:['replies','question'],
        data () {
      return {
        dialog: false,
        body:''
      }
    },
    methods:{
        createReply(){
            axios.post(`/api/question/${this.question.slug}/reply`,{body:this.body})
            .then(res => {
                this.replies.unshift(res.data.reply)
                this.dialog = false
                EventBus.$emit('newReplyAdded')
            })
        }
    }
    }
</script>

<style lang="scss" scoped>

</style>