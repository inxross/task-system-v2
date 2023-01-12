<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header">カテゴリー編集画面</div>

                <div class="card-body">
                        カテゴリ名<br>
                        <input type="text" class="form-control" name="category_name" v-model="category.name">
                        <br>
                        <ul v-for="error in errors" :key="error.id">
                            <li class="errorMessage">{{error}}</li>
                        </ul>
                        <br>
                        <button class="btn btn-success" @click="update">更新する</button>
                    <!--{{category.name}}
                    <br>
                    {{category.id}}-->
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
            errors: null
        };
    },
    computed: {
        category() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.categoryList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        update() {
            axios.post(
                '/api/category/update',
                {
                    category_name: this.category.name,
                    id: this.category.id
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "CategoryIndex"
                });
            })
            .catch(error => {
                console.log(error.response.data.errors.category_name);
                this.errors = error.response.data.errors.category_name;
            });

        },
    },
/*
    created() {
        //型確認
        console.log(typeof this.$route.params.id);
        const data = this.$store.state.categoryList.find(a => (
            a.id === this.$route.params.id
        ));
        console.log(typeof data.id);
    }
 */
}
</script>

<style>

</style>
