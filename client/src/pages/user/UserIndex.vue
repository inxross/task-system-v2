<template>
    <div>
        <h3>ユーザー管理画面</h3>

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
                <td><a class="btn btn-outline-success" href="#" role="button">編集</a></td>
                <td><a class="btn btn-outline-danger" href="#" role="button">削除</a></td>
                <td>{{user.updated_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
        };
    },
    created() {
        this.axios.get(
            'http://vue-laravel-separately-tasksystem.localdomain/api/userIndex'
        )
        .then(response => {
            this.users = response.data.users;
        });
    },

}
</script>

<style>

</style>
