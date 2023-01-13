<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">ユーザー新規作成画面</div>

                <div class="card-body">
                        ユーザー名<br>
                        <input type="text" class="form-control" name="user_name" v-model="createUserData.user_name">
                        <ul>
                            <div v-for="error in errors.user_name" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
                        <br>
                        メールアドレス<br>
                        <input type="email" class="form-control" name="email" v-model="createUserData.email">
                        <ul>
                            <div v-for="error in errors.email" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
                        <br>
                        Password<br>
                        <input type="password" class="form-control" name="password" v-model="createUserData.password">
                        <br>
                        Password確認<br>
                        <input type="password" class="form-control" name="password_confirmation" v-model="createUserData.password_confirmation">
                        <ul>
                            <div v-for="error in errors.password" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
                        <br>
                        <br>
                        <button class="btn btn-info" @click="register">登録する</button>
                    <!--{{createUserData}}-->
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
            errors: {
                user_name: [],
                email: [],
                password: []
            }
        };
    },
    methods: {
        register() {
            axios.post(
                '/api/user/store',
                {
                    user_name: this.createUserData.user_name,
                    email: this.createUserData.email,
                    password: this.createUserData.password,
                    password_confirmation: this.createUserData.password_confirmation
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

                if(error.response.data.errors.user_name) {
                    const errorsUserName = error.response.data.errors.user_name;
                    this.errors.user_name = errorsUserName.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.email) {
                    const errorsEmail = error.response.data.errors.email;
                    this.errors.email = errorsEmail.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.password) {
                    const errorsPassword = error.response.data.errors.password;
                    this.errors.password = errorsPassword.map((error) => {
                        return error
                    })
                }
                //this.errors = error.response.data.errors.category_name;
            });

            //this.createUserData.user_name = '';
        }
    },

}
</script>

<style>

</style>

