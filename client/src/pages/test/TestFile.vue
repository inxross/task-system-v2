<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-info">
                <div class="card-header">【テスト】ファイルUP</div>

                <div class="card-body">
                        ファイル<br>
                        <input @change="selectedFile" type="file" name="file">
                        <br>
                        <br>
                        <button class="btn btn-info" @click="register">登録する</button>

                    <!-- {{createTaskData}} -->

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
            uploadFile: null
        };
    },
    methods: {
        register() {
            let formData = new FormData();
            formData.append('uploadFile', this.uploadFile);
/*
            let config = {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            };
 */
            console.log(formData.get('uploadFile'));

            axios.post(
                '/api/test/file',
                {
                    formData
                },
                //config
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "TaskIndex"
                });
            })
            .catch(error => {
                console.log(error);
            });

            //this.createTaskData.task_name = '';
        },
        selectedFile: function(e) {
            // 選択された File の情報を保存しておく
            e.preventDefault();
            let files = e.target.files;
            this.uploadFile = files[0];
        },
    },

}
</script>

<style>

</style>

