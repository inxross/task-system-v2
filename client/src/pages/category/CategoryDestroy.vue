<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header">カテゴリー削除画面</div>

                <div class="card-body">
                        <h4 class="text-danger">以下のカテゴリを本当に削除してよろしいでしょうか？</h4>
                        <div class="p-3 mb-2 bg-secondary text-white">
                            <h5>{{ category.name }}</h5>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-danger" @click="destroy">削除する</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    computed: {
        category() {
            //const dataId = parseInt(this.$route.params.id, 10);
            const dataId = this.$route.params.id;
            const data = this.$store.state.categoryList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        destroy() {
            axios.post(
                '/api/category/destroy',
                {
                    id: this.category.id
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "CategoryIndex"
                });
            });

        },
    },
}
</script>

<style>

</style>
