<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-success">
                <div class="card-header">タスク編集画面</div>

                <div class="card-body">
                        タスク名<br>
                        <input type="text" class="form-control" name="task_name" v-model="task.name">
                        <ul>
                            <div v-for="error in errors.task_name" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        タスク説明文<br>
                        <textarea class="form-control" rows="10" name="description" v-model="task.description"></textarea>
                        <ul>
                            <div v-for="error in errors.description" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        担当者<br>
                        <select v-model="task.work_user.id">
                             <option value="">選択してください</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                        </select>
                        <ul>
                            <div v-for="error in errors.work_user" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        進捗度<br>
                        <input type="integer" name="progress" v-model="task.progress">
                        <ul>
                            <div v-for="error in errors.progress" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        工数<br>
                        <input type="integer" name="man_hours" v-model="task.man_hours">
                        <ul>
                            <div v-for="error in errors.man_hours" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        ステータス<br>
                        <select v-model="task.status_id">
                             <option value="">選択してください</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
                        </select>
                        <ul>
                            <div v-for="error in errors.status" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        カテゴリ<br>
                        <select v-model="task.category_id">
                             <option value="">選択してください</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                        </select>
                        <ul>
                            <div v-for="error in errors.category" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>

                        締切日<br>
                        <input type="date" name="deadline" v-model="task.deadline">
                        <ul></ul>

                        ファイル<br>
                        <input type="file" name="file" multiple v-on:change="fileSelected">
                        <div v-for="fileInfo in filesInfo" :key="fileInfo.id">
                                {{ fileInfo.name}}
                        </div>
                        <ul></ul>
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
    data() {
        return {
            filesInfo: [],
            taskId: '',
            errors: {
                task_name: [],
                description: [],
                work_user: [],
                status: [],
                category: [],
                progress: [],
                man_hours: [],
            }
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
        task() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.taskList.find(a => (
                a.id === dataId
            ));
            return data;
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
        update() {
            axios.post(
                '/api/task/update',
                {
                    id: this.task.id,
                    task_name: this.task.name,
                    description: this.task.description,
                    work_user: this.task.work_user.id,
                    status: this.task.status_id,
                    category: this.task.category_id,
                    deadline: this.task.deadline,
                    progress: this.task.progress,
                    man_hours: this.task.man_hours,
                    //task: this.task
                }
            )
            .then(response => {
                console.log(response);
                this.taskId = response.data.task.id;

                if(this.filesInfo.length != 0) {
                    this.fileUpload();
                } else {
                    this.$router.push({
                        name: "TaskIndex"
                    });
                }
            })
            .catch(error => {
                //初期化
                this.errors.task_name = [];
                this.errors.description = [];
                this.errors.work_user = [];
                this.errors.status = [];
                this.errors.category = [];
                this.errors.progress = [];
                this.errors.man_hours = [];

                console.log(error.response.data.errors);

                if(error.response.data.errors.task_name) {
                    const errorsTaskName = error.response.data.errors.task_name;
                    this.errors.task_name = errorsTaskName.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.description) {
                    const errorsDescription = error.response.data.errors.description;
                    this.errors.description = errorsDescription.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.work_user) {
                    const errorsWorkUser = error.response.data.errors.work_user;
                    this.errors.work_user = errorsWorkUser.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.status) {
                    const errorsStatus = error.response.data.errors.status;
                    this.errors.status = errorsStatus.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.category) {
                    const errorsCategory = error.response.data.errors.category;
                    this.errors.category = errorsCategory.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.progress) {
                    const errorsProgress = error.response.data.errors.progress;
                    this.errors.progress = errorsProgress.map((error) => {
                        return error
                    })
                }
                if(error.response.data.errors.man_hours) {
                    const errorsManHours = error.response.data.errors.man_hours;
                    this.errors.man_hours = errorsManHours.map((error) => {
                        return error
                    })
                }
            });

        },
        fileSelected(event){
            //console.log(event);
            const ObjectFilesInfo = event.target.files;
            const ArrayFilesInfo = Object.values(ObjectFilesInfo);    //オブジェクトはmap処理やforEach処理を使えないので、1度配列にする。
            this.filesInfo = ArrayFilesInfo;
        },
        fileUpload(){
            const formData = new FormData();

            this.filesInfo.forEach((file, index) => {
                formData.append(`files[${index}]`, file) // formDataに追加していく
            });

            formData.append('taskId',this.taskId);
            formData.append('admin_user',this.loginUserId);

            console.log(...formData.entries());

            axios.post(
                '/api/file/upload',
                formData
            )
            .then(response =>{
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

