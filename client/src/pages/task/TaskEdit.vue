<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-success">
                <div class="card-header">タスク編集画面</div>

                <div class="card-body">
                        タスク名<br>
                        <input type="text" class="form-control" name="task_name" v-model="task.name">
                        <br>
                        タスク説明文<br>
                        <textarea class="form-control" rows="10" name="description" v-model="task.description"></textarea>
                        <br>
                        担当者<br>
                        <select v-model="task.work_user.id">
                             <option value="">選択してください</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                        </select>
                        <br>
                        進捗度<br>
                        <input type="integer" name="progress" v-model="task.progress">
                        <br>
                        工数<br>
                        <input type="integer" name="man_hours" v-model="task.man_hours">
                        <br>
                        ステータス<br>
                        <select v-model="task.status_id">
                             <option value="">選択してください</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
                        </select>
                        <br>
                        カテゴリ<br>
                        <select v-model="task.category_id">
                             <option value="">選択してください</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                        </select>
                        <br>
                        締切日<br>
                        <input type="date" name="deadline" v-model="task.deadline">
                        <br>
                        <br>
                        <button class="btn btn-success" @click="update">更新する</button>

                    <!-- {{task}} -->

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
        users() {
            return this.$store.getters.userList;
        },
        statuses() {
            return this.$store.getters.statusList;
        },
        categories() {
            return this.$store.getters.categoryList;
        },
        task() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.taskList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },

    created() {
        this.$store.dispatch('updateUserList');
        this.$store.dispatch('updateStatusList');
        this.$store.dispatch('updateCategoryList');
    },

    methods: {
        update() {
            axios.post(
                '/api/task/update',
                {
                    task: this.task
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "TaskIndex"
                });
            });

        }
    },

}
</script>

<style>

</style>

