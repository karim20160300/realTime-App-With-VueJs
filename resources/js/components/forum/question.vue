<template>
    <div>
    <v-card>
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    <router-link :to="question.path">{{question.title}}</router-link>
                </h3>
                {{question.user}}
                <div class="grey--text">
                    {{question.created_at}}</div>
            </div>
        </v-card-title>
        <v-card-text>
            {{question.body}}
        </v-card-text>
    </v-card>
    <br>
    </div>
</template>

<script>
    export default {
        props:['question'],
    }
</script>

<style lang="scss" scoped>

</style>