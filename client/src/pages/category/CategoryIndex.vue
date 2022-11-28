<template>
    <div class="card">
        <div class="card-header">カテゴリー管理画面</div>

        <div class="card-body">

            <button v-on:click="create" class="btn btn-outline-primary">
                新規登録
            </button>

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
                    <td><button class="btn btn-outline-success" @click="goEdit(category.id)">編集</button></td>
                    <td><button class="btn btn-outline-danger" @click="goDestroy(category.id)">削除</button></td>
                    <td>{{category.updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

    computed: {
        categories() {
            return this.$store.getters.categoryList;
        }
    },
    created() {
        this.$store.dispatch('updateCategoryList');
    },
    methods: {
        create() {
            this.$router.push({
                name: "CategoryCreate"
            });
        },
        goEdit(id) {
            this.$router.push({
                name: "CategoryEdit",
                params: { id: id}
            })
        },
        goDestroy(id) {
            this.$router.push({
                name: "CategoryDestroy",
                params: { id: id}
            })
        },
    }

}
</script>

<style>

</style>
