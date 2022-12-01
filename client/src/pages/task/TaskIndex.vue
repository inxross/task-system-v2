<template>
    <div class="card">
        <div class="card-header">タスク管理画面</div>

        <div class="card-body">

            <button v-on:click="create" class="btn btn-outline-primary">
                新規登録
            </button>

            <table class="table table-hover my-2">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">ステータス</th>
                    <th scope="col">タスク名</th>
                    <th scope="col">担当者</th>
                    <th scope="col">締切日</th>
                    <th scope="col">更新日時</th>
                    </tr>
                </thead>
                <tbody v-for="task in tasks" :key="task.id">
                <tr  @click="goShow(task.id)">
                    <td>{{task.id}}</td>
                    <td>{{task.status ? task.status.name : ''}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.work_user ? task.work_user.name : ''}}</td>
                    <td>{{task.deadline}}</td>
                    <td>{{task.updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

    computed: {
        tasks() {
            return this.$store.getters.taskList;
        }
    },
    created() {
        this.$store.dispatch('updateTaskList');
    },
    methods: {
        create() {
            this.$router.push({
                name: "TaskCreate"
            });
        },
        goShow(id) {
            this.$router.push({
                name: "TaskShow",
                params: { id: id}
            })
        },
    }

}
</script>

<style>

</style>

