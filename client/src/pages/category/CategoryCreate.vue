<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">カテゴリー新規作成画面</div>

                <div class="card-body">
                        カテゴリ名<br>
                        <input type="text" class="form-control" name="category_name" v-model="createCategoryData.category_name">
                        <br>
                        <br>
                        <button class="btn btn-info" @click="register">登録する</button>
                    <!-- {{createCategoryData}} -->
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
            createCategoryData: {
                category_name: '',
            },
        };
    },
    methods: {
        register() {
            axios.post(
                '/api/category/store',
                {
                    category_name: this.createCategoryData.category_name
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "CategoryIndex"
                });
            });

            this.createCategoryData.category_name = '';
        }
    },

}
</script>

<style>

</style>
