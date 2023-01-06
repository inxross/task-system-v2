<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">ログイン画面</div>

                <div class="card-body">
                        メールアドレス<br>
                        <input type="email" class="form-control" name="email" v-model="loginData.email">
                        <br>
                        Password<br>
                        <input type="password" class="form-control" name="password" v-model="loginData.password">
                        <br>

                        <br>
                        <button class="btn btn-info" @click="login">ログイン</button>
                        <!--{{loginData}}-->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

export default {
    data() {
        return {
            loginData: {
                email: '',
                password: '',
            },
        };
    },
    methods: {
        login() {
            this.$store.dispatch('login', this.loginData);
        }
    },

}
</script>

<style>

</style>

