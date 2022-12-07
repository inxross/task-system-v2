<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">タスク詳細画面</div>

                <div class="card-body">
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
                            <div class="card-footer text-muted">
                                <button class="btn btn-outline-success" @click="goEdit(task.id)">編集</button>

                                <button class="btn btn-outline-danger mx-4" @click="goDestroy(task.id)">削除</button>
                            </div>
                        </div>

                        <br>
                        <div method="POST" action="#" enctype="multipart/form-data">
                            <textarea class="form-control" rows="5" name="comment" v-model="comment"></textarea>
                            <!--{{comment}}-->
                            <input type="hidden" name="user" value="">
                            <button class="btn btn-dark mt-1" @click="commentSubmit">コメント投稿する</button>
                        </div>
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
            comment: '',
        };
    },
    computed: {
        task() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.taskList.find(a => (
                a.id === dataId
            ));
            console.log(data);
            return data;
        }
    },
    created() {
        this.$store.dispatch('updateTaskList');
    },
    methods: {
        goEdit(id) {
            this.$router.push({
                name: "TaskEdit",
                params: { id: id}
            })
        },
        goDestroy(id) {
            this.$router.push({
                name: "TaskDestroy",
                params: { id: id}
            })
        },
        commentSubmit() {
            axios.post(
                '/api/comment/store',
                {
                    comment: this.comment,
                    task_id: this.task.id
                }
            )
            .then(response => {
                console.log(response);
                this.comment = '';
            });
        }
    },

}
</script>

<style>
.newline {
  white-space: pre-wrap;
}
</style>

