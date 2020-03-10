<template>
    <v-container>
    <v-form @submit.prevent="edit">
      <v-text-field
        v-model="form.title"
        label="Title"
        type="text"
        required
      ></v-text-field>
     
    
    <vue-simplemde v-model="form.body" ref="markdownEditor" />
     
      
      <v-card-actions>
          <v-btn icon small type="submit">
              <v-icon color="green">save</v-icon>
          </v-btn>
          <v-btn icon small @click="cancel">
              <v-icon color="teal">cancel</v-icon>
          </v-btn>
      </v-card-actions>
      
    </v-form>
</v-container>
</template>

<script>
    export default {
        props:['question'],
        data(){
            return{
                form:{
                    title:null,
                    body:null,
                },
                categories:{},
                errors:{}
            }
        },
        created(){
            this.form = this.question
        },
        methods:{
            edit(){
                this.doEdit(this.form)
            },
            doEdit(form){
                axios.patch(`/api/question/${this.question.slug}`, form)
                .then(res => this.cancel())
            },
            cancel(){
                EventBus.$emit('cancelEditing')
            }
        }

    }
</script>

<style lang="scss" scoped>

</style>