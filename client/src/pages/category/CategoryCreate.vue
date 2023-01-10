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
                        <div class="error" v-if="!$v.category_name.required">Field is required</div>
                        <div class="error" v-if="!$v.category_name.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</div>
                        <tree-view :data="$v.category_name" :options="{rootObjectKey: '$v.category_name', maxDepth: 2}"></tree-view>
                        <br>
                        <button class="btn btn-info" @click="register">登録する</button>
                    <!-- {{createCategoryData}} -->
                    {{$v.category_name}}
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import { required, minLength } from 'vuelidate/lib/validators';

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
    validations: {
        category_name: {
            required,
            minLength: minLength(4)
        },
    }

}
</script>

<style>

</style>
