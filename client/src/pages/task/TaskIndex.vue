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
                <tbody v-for="task in afterSliceComputedTasksForPaginate" :key="task.id">
                <tr  @click="goShow(task.id)">
                    <td>{{task.id}}</td>
                    <td>{{task.status ? task.status.name : ''}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.work_user ? task.work_user.name : ''}}</td>
                    <td>{{task.deadline}}</td>
                    <td>{{task.updated_at | moment }}</td>
                </tr>
                </tbody>
                <!--{{afterSliceComputedTasksForPaginate}}-->
            </table>

            <VuePaginate
                :page-count="getPageCount"
                :page-range="3"
                :margin-pages="2"
                :click-handler="clickCallback"
                :prev-text="'＜'"
                :next-text="'＞'"
                :container-class="'pagination'"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-class="'page-item'"
                :prev-link-class="'page-link'"
                :next-class="'page-item'"
                :next-link-class="'page-link'">
            </VuePaginate>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    data() {
        return {
            currentPage: 1,
            perPage: 10,
        };
    },
    computed: {
        computedTasks() {
            const getters = this.$store.getters.taskList;

            //console.log(this.$route.query.category);



            if ((this.$route.query.category == 0 && this.$route.query.status == 0 && this.$route.query.user == 0 && this.$route.query.searchword == '') || (!this.$route.query.category && !this.$route.query.status && !this.$route.query.user && !this.$route.query.searchword)) {
                //console.log(getters);
                return getters;
            } else {
                const categoryDataId = parseInt(this.$route.query.category, 10);
                const statusDataId = parseInt(this.$route.query.status, 10);
                const userDataId = parseInt(this.$route.query.user, 10);
                const searchword = this.$route.query.searchword;
                //console.log(searchword);

                let tentativeData = getters.filter( function(a) {

                    return (categoryDataId==0 ? a.category_id !== categoryDataId : a.category_id == categoryDataId) && (statusDataId==0 ? a.status_id !== statusDataId : a.status_id == statusDataId) && (userDataId==0 ? a.work_user.id !== userDataId : a.work_user.id == userDataId);
                })

                if( searchword=='' || !searchword ) {
                    //console.log('searchwordなしの処理を通っている');
                    const finalData = tentativeData
                    return finalData;
                } else {
                    const finalData = tentativeData.filter( function(b) {
                        //console.log('searchwordありの処理を通っている');
                        return b.name.match(searchword);
                    })
                    return finalData;
                }

                //console.log(finalData);
                //return finalData;
            }

        },
        afterSliceComputedTasksForPaginate() {
            let current = this.currentPage * this.perPage;
            let start = current - this.perPage;

            return this.computedTasks.slice(start, current);
        },
        getPageCount() {
            //console.log(this.computedTasks.length);
            return Math.ceil(this.computedTasks.length / this.perPage);
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
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        }
    },
    filters: {
        moment: function (date) {
            return moment(date).format('YYYY/MM/DD');
        }
    }

}
</script>

<style>

</style>

