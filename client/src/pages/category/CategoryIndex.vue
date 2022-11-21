<template>
    <div class="card">
        <div class="card-header">カテゴリー管理画面</div>

        <div class="card-body">
            <table class="table table-hover my-2">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">カテゴリ名</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">更新日</th>
                    </tr>
                </thead>
                <tbody v-for="category in categories" :key="category.id">
                <tr>
                    <th>{{category.id}}</th>
                    <td>{{category.name}}</td>
                    <td><a class="btn btn-outline-success" href="#" role="button">編集</a></td>
                    <td><a class="btn btn-outline-danger" href="#" role="button">削除</a></td>
                    <td>{{category.updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
        };
    },
    created() {
        this.axios.get(
            'http://vue-laravel-separately-tasksystem.localdomain/api/categoryIndex'
        )
        .then(response => {
            console.log(response);
            this.categories = response.data.categories;
        });
    },

}
</script>

<style>

</style>
