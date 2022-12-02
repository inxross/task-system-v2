<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header">
                    パスワード編集画面
                </div>

                <div class="card-body">
                        ユーザー名：{{user.name}}
                        <br>
                        <br>
                        Password<br>
                        <input type="password" class="form-control" name="password" v-model="user.password">
                        Password確認<br>
                        <input type="password" class="form-control" name="password_confirmation" v-model="user.password_confirmation">
                        <br>
                        <button class="btn btn-success" @click="update">更新する</button>
                    <!-- {{user.password}}
                    <br>
                    {{user.password_confirmation}} -->
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
            //const dataId = parseInt(this.$route.params.id, 10);
            const dataId = this.$route.params.id;
            const data = this.$store.getters.userList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        update() {
            axios.post(
                '/api/user/passwordUpdate',
                {
                    password: this.user.password,
                    password_confirmation: this.user.password_confirmation,
                    id: this.user.id
                }
            )
            .then(response => {
                console.log(response);
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
