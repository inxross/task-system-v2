<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">タスク詳細画面</div>
                <template v-if="destroyMessage">
                    <destroy-message/>
                </template>
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
                                    <td v-if="task.deadline">{{task.deadline | moment}}</td>
                                    <td v-else></td>
                                    <td>{{task.progress}}</td>
                                    <td>{{task.man_hours}}</td>
                                    <td>{{task.updated_at | moment_HH_mm}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div :id="idForDescription" class="card-body">
                                <p class="card-text newline">{{task.description}}</p>

                                <div v-for="file in files" :key="file.id">
                                    <a v-if="loginUserId == file.user_id" @click="fileDestroy(file)" href="javaScript:void(0)" class="btn btn-outline-danger btn-sm mt-1 py-0">削除</a>
                                    <a href="javaScript:void(0)" @click="fileDownload(file)" class="mx-1">{{ file.original_name}}</a>
                                </div>

                            </div>
                            <div class="card-footer text-muted">
                                <button class="btn btn-outline-success" @click="goEdit(task.id)">編集</button>

                                <button class="btn btn-outline-danger mx-4" @click="goDestroy(task.id)">削除</button>
                            </div>
                        </div>

                        <br>
                        <!--{{comments}}-->
                        <div class="card" v-for="comment in comments" :key="comment.id">
                            <div class="card-header text-muted" style="position: relative;">
                                <div style="display: inline;">投稿者：{{ comment.user ? comment.user.name : ''}}</div>
                                <div style="display: inline; position: absolute; right: 15px;">{{ comment.created_at | moment_HH_mm }}</div>
                            </div>
                            <div class="card-body">
                                <p class="card-text newline">{{comment.text}}</p>
                                <template v-if="comment.files">
                                    <div v-for="file in comment.files" :key="file.id">
                                        <a href="javaScript:void(0)" @click="fileDownload(file)">{{file.original_name}}</a>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <br>
                        <div method="POST" action="#" enctype="multipart/form-data">
                            <textarea class="form-control" rows="5" name="comment" v-model="comment"></textarea>
                            <!--{{comment}}-->
                            <input type="hidden" name="user" v-model="loginUserId">

                        </div>
                        <select class="mt-2 mx-1" v-model="workUserId">
                            <option value="0" selected>担当者変更</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                        </select>
                        <select class="mt-2 mx-1" v-model="statusId">
                            <option value="0" selected>ステータス変更</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
                        </select>
                        <br>
                        <input class="mt-2 mx-1" type="file" name="file" multiple v-on:change="fileSelected">
                        <br>
                        <button class="btn btn-dark mt-2" @click="commentSubmit">投稿する</button>
                        <!--{{commentForWorkUser}}-->
                        <!--{{commentForStatus}}-->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
import DestroyMessage from "../../global/message/DestroyMessage.vue";

export default {
    components: {
        'destroy-message': DestroyMessage
    },
    data() {
        return {
            comment: '',
            commentForWorkUser: '',
            commentForStatus: '',
            workUserId: '0',
            statusId: '0',
            filesInfo: [],
            commentId: '',
            destroyMessage: false
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
        },
        comments() {
            return this.$store.getters.commentList;
        },
        users() {
            return this.$store.getters.userList;
        },
        statuses() {
            return this.$store.getters.statusList;
        },
        loginUserId() {
            return this.$store.getters.loginUser.id;
        },
        files() {
            return this.$store.getters.fileList;
        },
        idForDescription() {
            const taskId = this.$route.params.id
            return `description_${taskId}`;
        }
    },
    watch: {
        workUserId() {
            if(this.workUserId != '0') {
                var vm = this;
                const workUser = this.$store.getters.userList.find(a => (
                    a.id == vm.workUserId
                ));
                this.commentForWorkUser = `担当者を【${workUser.name}】に変更しました。`;
            }

            if(this.workUserId == '0') {
                this.commentForWorkUser = '';
            }
        },
        statusId() {
            if(this.statusId != '0') {
                var vm = this;
                const status = this.$store.getters.statusList.find(a => (
                    a.id == vm.statusId
                ));
                this.commentForStatus = `ステータスを【${status.name}】に変更しました。`;
            }

            if(this.statusId == '0') {
                this.commentForStatus = '';
            }
        }
    },
    created() {
        this.$store.dispatch('updateTaskList');
        this.$store.dispatch('updateCommentList', this.$route.params.id);
        this.$store.dispatch('updateUserList');
        this.$store.dispatch('updateStatusList');
        this.$store.dispatch('updateFileList', this.$route.params.id);
        //console.log(typeof this.$route.params.id);
    },
    filters: {
        moment: function (date) {
            return moment(date).format('YYYY/MM/DD');
        },
        moment_HH_mm: function (date) {
            return moment(date).format('YYYY/MM/DD HH:mm');
        }
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
                    commentForWorkUser: this.commentForWorkUser,
                    commentForStatus: this.commentForStatus,
                    user_id: this.loginUserId,
                    task_id: this.task.id,
                    workUserId: this.workUserId,
                    statusId: this.statusId,
                }
            )
            .then(response => {
                console.log(response);
                this.comment = '';
                this.commentForWorkUser = '';
                this.commentForStatus = '';

                if(response.data.commentId) {
                    this.commentId = response.data.commentId;
                }

                //this.$router.go({path: this.$router.currentRoute.path, force: true});
                if(this.filesInfo.length != 0) {
                    this.fileUpload(this.commentId);
                } else {
                    this.$router.go({path: this.$router.currentRoute.path, force: true});
                }
            })
            .catch(error => {

                if(this.filesInfo.length != 0) {
                    this.fileUpload(this.commentId);
                } else {
                    console.log(error);
                }

                //console.log(error);
            });
        },
        fileDownload(file) {
            const fileId = file.id;
            axios.post(
                '/api/file/download',
                {
                    file_id: fileId
                },
            )
            .then(response => {
                console.log(response);
                this.downloadByURL(response.data.pathToFile, response.data.file.original_name);
            })
            .catch(error => {
                console.log(error);
            });
        },
        downloadByURL(url, fileName) {
            const link = document.createElement('a')
            link.download = `${fileName}`
            link.href = url
            link.target = "_blank"
            link.click()
        },
        fileSelected(event){
            //console.log(event);
            const ObjectFilesInfo = event.target.files;
            const ArrayFilesInfo = Object.values(ObjectFilesInfo);    //オブジェクトはmap処理やforEach処理を使えないので、1度配列にする。
            this.filesInfo = ArrayFilesInfo;
            console.log(this.filesInfo);
        },
        fileUpload(commentId){
            const formData = new FormData();

            this.filesInfo.forEach((file, index) => {
                formData.append(`files[${index}]`, file) // formDataに追加していく
            });

            formData.append('taskId',this.task.id);
            formData.append('admin_user',this.loginUserId);
            formData.append('commentId',commentId);
            formData.append('fromComment',true);

            console.log(...formData.entries());

            axios.post(
                '/api/file/fromComment/upload',
                formData
            )
            .then(response =>{
                console.log(response);

                this.$router.go({path: this.$router.currentRoute.path, force: true});
            });
        },
        fileDestroy(file){
            const fileId = file.id;

            axios.post(
                '/api/file/destroy',
                {
                    file_id: fileId
                },
            )
            .then(response => {
                console.log(response);
                //this.createDeleteMessage(response.data.originalName);
                this.$router.go({path: this.$router.currentRoute.path, force: true});
                //this.destroyMessage = true;
            })
            .then(() => {
                this.destroyMessageFunction();
            })
            .catch(error => {
                console.log(error);
            });
        },
        destroyMessageFunction() {
            this.destroyMessage = true;
        },
/*
        createDeleteMessage(name) {
            const description = document.getElementById(this.idForDescription);
            console.log(description);
            const p = document.createElement('p');
            p.classList.add('deleted');
            p.textContent = `${name}が削除されました。`;
            description.appendChild(p);
        },
 */
    },

}
</script>

<style>
.newline {
  white-space: pre-wrap;
}
</style>

