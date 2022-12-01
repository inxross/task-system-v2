<template>
    <div class="card">
        <div class="card-header">ユーザー管理画面</div>

        <div class="card-body">

            <button v-on:click="create" class="btn btn-outline-primary">
                新規登録
            </button>

            <table class="table table-hover my-2">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">ユーザー名</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">更新日</th>
                    </tr>
                </thead>
                <tbody v-for="user in users" :key="user.id">
                <tr>
                    <th>{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td><button class="btn btn-outline-success" @click="goEdit(user.id)">編集</button></td>
                    <td><button class="btn btn-outline-danger" @click="goDestroy(user.id)">削除</button></td>
                    <td>{{user.updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

    computed: {
        users() {
            return this.$store.getters.userList;
        }
    },
    created() {
        this.$store.dispatch('updateUserList');
    },
    methods: {
        create() {
            this.$router.push({
                name: "UserCreate"
            });
        },
        goEdit(id) {
            this.$router.push({
                name: "UserEdit",
                params: { id: id}
            })
        },
        goDestroy(id) {
            this.$router.push({
                name: "UserDestroy",
                params: { id: id}
            })
        },
    }

}
</script>

<style>

</style>
