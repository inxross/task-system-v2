<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">ステータス新規作成画面</div>

                <div class="card-body">
                        ステータス名<br>
                        <input type="text" class="form-control" name="status_name" v-model="createStatusData.status_name">
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
            createStatusData: {
                status_name: '',
            },
        };
    },
    methods: {
        register() {
            axios.post(
                '/api/status/store',
                {
                    status_name: this.createStatusData.status_name
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "StatusIndex"
                });
            });

            this.createStatusData.status_name = '';
        }
    },

}
</script>

<style>

</style>
