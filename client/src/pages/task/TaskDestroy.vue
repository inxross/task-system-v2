<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class="card-header">タスク削除画面</div>

                <div class="card-body">
                        <h4 class="text-danger">以下のタスクを本当に削除してよろしいでしょうか？</h4>
                        <div class="card">
                            <div class="card-header">
                                <h4>{{task.name}}</h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr class="table-active">
                                    <th scope="col">id</th>
                                    <th scope="col">ステータス</th>
                                    <th scope="col">担当者</th>
                                    <th scope="col">登録者</th>
                                    <th scope="col">カテゴリ</th>
                                    <th scope="col">期日</th>
                                    <th scope="col">進捗率</th>
                                    <th scope="col">工数</th>
                                    <th scope="col">更新日時</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-active">
                                    <td>{{task.id}}</td>
                                    <td>{{task.status ? task.status.name : ''}}</td>
                                    <td>{{task.work_user ? task.work_user.name : ''}}</td>
                                    <td>{{task.admin_user ? task.admin_user.name : ''}}</td>
                                    <td>{{task.category ? task.category.name : ''}}</td>
                                    <td>{{task.deadline}}</td>
                                    <td>{{task.progress}}</td>
                                    <td>{{task.man_hours}}</td>
                                    <td>{{task.updated_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-body">
                                <p class="card-text newline">{{task.description}}</p>
                            </div>
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
        task() {
            //const dataId = parseInt(this.$route.params.id, 10);
            const dataId = this.$route.params.id;
            const data = this.$store.getters.taskList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        destroy() {
            axios.post(
                '/api/task/destroy',
                {
                    id: this.task.id
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "TaskIndex"
                });
            });

        },
    },
}
</script>

<style>

</style>
