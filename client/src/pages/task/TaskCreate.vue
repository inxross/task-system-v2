<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-info">
                <div class="card-header">タスク新規作成画面</div>

                <div class="card-body">
                        タスク名<br>
                        <input type="text" class="form-control" name="task_name" v-model="createTaskData.task_name">
                        <br>
                        タスク説明文<br>
                        <textarea class="form-control" rows="10" name="description" v-model="createTaskData.description"></textarea>
                        <br>
                        登録者：{{ $store.getters.loginUser.name }}
                        <input type="hidden" name="admin_user" :value="loginUserId">
                        <br>
                        担当者<br>
                        <select v-model="createTaskData.work_user">
                             <option value="">選択してください</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                        </select>
                        <br>
                        ステータス<br>
                        <select v-model="createTaskData.status">
                             <option value="">選択してください</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
                        </select>
                        <br>
                        カテゴリ<br>
                        <select v-model="createTaskData.category">
                             <option value="">選択してください</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                        </select>
                        <br>
                        締切日<br>
                        <input type="date" name="deadline" v-model="createTaskData.deadline">
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
            createTaskData: {
                task_name: '',
                description: '',
                work_user: '',
                status: '',
                category: '',
                deadline: '',
            },
        };
    },
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
        loginUserId() {
            return this.$store.getters.loginUser.id;
        }
    },
    created() {
        this.$store.dispatch('updateUserList');
        this.$store.dispatch('updateStatusList');
        this.$store.dispatch('updateCategoryList');
    },
    methods: {
        register() {
            axios.post(
                '/api/task/store',
                {
                    createTaskData: this.createTaskData,
                    admin_user: this.loginUserId
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "TaskIndex"
                });
            });

            //this.createTaskData.task_name = '';
        }
    },

}
</script>

<style>

</style>

