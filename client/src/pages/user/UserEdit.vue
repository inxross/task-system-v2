<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header">
                    ユーザー編集画面
                    <div style="text-align: right;">
                        <button @click="goPasswordEdit(user.id)" class="btn btn-outline-success btn-sm text-right">パスワード編集</button>
                    </div>
                </div>

                <div class="card-body">
                        ユーザー名<br>
                        <input type="text" class="form-control" name="user_name" v-model="user.name">
                        <br>
                        メールアドレス<br>
                        <input type="email" class="form-control" name="email" v-model="user.email">
                        <br>
                        <button class="btn btn-success" @click="update">更新する</button>
                    <!--{{user.name}}
                    <br>
                    {{user.id}} -->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    computed: {
        user() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.userList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        update() {
            axios.post(
                '/api/user/update',
                {
                    user_name: this.user.name,
                    email: this.user.email,
                    id: this.user.id
                }
            )
            .then(response => {
                console.log(response);

                if(this.$store.getters.loginUser.id === this.user.id){
                    this.$store.dispatch('updateLoginUser', this.user.id);
                }

                this.$router.push({
                    name: "UserIndex"
                });
            });
        },
        goPasswordEdit(id) {
            this.$router.push({
                name: "PasswordEdit",
                params: { id: id}
            })
        },
    },
}
</script>

<style>

</style>
