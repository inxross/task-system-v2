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
                        <ul>
                            <div v-for="error in errors.password" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
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
    data() {
        return {
            errors: {
                password: []
            }
        };
    },
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
            })
            .catch(error => {
                console.log(error.response.data.errors);

                if(error.response.data.errors.password) {
                    const errorsPassword = error.response.data.errors.password;
                    this.errors.password = errorsPassword.map((error) => {
                        return error
                    })
                }
            });
        },
    },
}
</script>

<style>

</style>
