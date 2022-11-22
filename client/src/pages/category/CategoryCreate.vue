<template>
    <div class="card">
        <div class="card-header">カテゴリー新規作成画面</div>

        <div class="card-body">
            <form @submit='register'>
                カテゴリ名<br>
                <input type="text" class="form-control" name="category_name" v-model="createCategoryData.category_name">
                <br>
                <br>
                <input class="btn btn-info" type="submit" value="登録する">
            </form>
            <!-- {{createCategoryData}} -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            createCategoryData: {
                category_name: '',
            },
        };
    },
    methods: {
        register() {
            this.axios.post(
                'http://vue-laravel-separately-tasksystem.localdomain/api/category/store',
                {
                    category_name: this.createCategoryData.category_name
                }
            )
            .then(response => {
                console.log(response);
            });

            this.createCategoryData.category_name = '';
        }
    },

}
</script>

<style>

</style>
