<template>
    <div class="mt-2 mr-4">
            <v-menu
      transition="slide-x-transition"
      bottom
      right
    >
      <template v-slot:activator="{ on }">
        <v-badge
        :content="unreadCount"
        :value="unreadCount"
        color="red"
        overlap
         >
        <v-icon color="pink" v-on="on" large>notification_important</v-icon>
        </v-badge>
      </template>

      <v-list>
        <v-list-item v-for="notification in unread" :key="notification.id">
            <router-link :to="notification.questionPath">
                <v-list-item-title @click="readIt(notification)">{{notification.questionTitle}}</v-list-item-title>
            </router-link>
        </v-list-item>

        <v-list-item v-for="notification in read" :key="notification.id">

        <v-list-item-title @click="readIt(notification)">{{notification.questionTitle}}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
        </div>
    
</template>

<script>
    export default {
        data(){
            return {
                read: {},
                unread: {},
                unreadCount:{}
            }
        },
        created(){
            if(User.loggedIn()){
                this.getNotifications();
            }

            Echo.private('App.User.' + User.id())
            .notification((notification) => {
            this.unread.unshift(notification)
            this.unreadCount++
            this.$toaster.success(`Your Question (${notification.questionTitle}) Replied By Mr: ${notification.replyBy}`)
             });
        },
        methods:{
            getNotifications(){
                axios.post('/api/notifications')
                .then(res=> [
                    this.read = res.data.read,
                    this.unread = res.data.unread,
                    this.unreadCount = res.data.unread.length
                ])
            },
            readIt(notification){
                axios.post('/api/markAsRead', {id:notification.id})
                .then(res => {
                    this.unread.splice(notification,1)
                    this.read.push(notification)
                    this.unreadCount--
                })
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>