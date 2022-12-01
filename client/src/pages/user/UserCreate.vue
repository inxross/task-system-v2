<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">ユーザー新規作成画面</div>

                <div class="card-body">
                        ユーザー名<br>
                        <input type="text" class="form-control" name="user_name" v-model="createUserData.user_name">
                        <br>
                        メールアドレス<br>
                        <input type="email" class="form-control" name="email" v-model="createUserData.email">
                        <br>
                        Password<br>
                        <input type="password" class="form-control" name="password" v-model="createUserData.password">
                        <br>
                        Password確認<br>
                        <input type="password" class="form-control" name="password_confirmation" v-model="createUserData.password_confirmation">
                        <br>
                        <br>
                        <button class="btn btn-info" @click="register">登録する</button>
                    {{createUserData}}
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            createUserData: {
                user_name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
        };
    },
    methods: {
        register() {
            axios.post(
                '/api/user/store',
                {
                    createUserData: this.createUserData
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "UserIndex"
                });
            });

            //this.createUserData.user_name = '';
        }
    },

}
</script>

<style>

</style>

