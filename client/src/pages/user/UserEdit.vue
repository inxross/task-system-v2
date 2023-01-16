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
                        <ul>
                            <div v-for="error in errors.user_name" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
                        <br>
                        メールアドレス<br>
                        <input type="email" class="form-control" name="email" v-model="user.email">
                        <ul>
                            <div v-for="error in errors.email" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
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
    data() {
        return {
            errors: {
                user_name: [],
                email: [],
            }
        };
    },
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
            const userId = this.user.id;
            axios.post(
                `/api/user/update/${userId}`,
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
