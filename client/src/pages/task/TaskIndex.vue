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
                <tbody v-for="task in computedTasks" :key="task.id">
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
/*
    data() {
        return {
            tasks: [],
        };
    },
 */
    computed: {
        computedTasks() {
            let getters = this.$store.getters.taskList;

            console.log(this.$route.query.category);

            if (this.$route.query.caterory !== 0) {
                const dataId = this.$route.query.category;
                const data = getters.filter( function(a) {
                    return a.category_id == dataId;
                })

                console.log('if文の処理');
                console.log(data);
                getters = data;
            } else {
                console.log('else文の処理');
                console.log(getters);
            }

            return getters;
        }
    },
/*
    watch: {
        $route(to) {
            console.log(to.query.category);
            console.log(this.computedTasks);
            console.log(to);

            if (to.query.caterory == null) {
                const dataId = this.$route.query.category;
                const data = this.computedTasks.filter( function(a) {
                    return a.category_id == dataId;
                })

                console.log('if文の処理');
                console.log(data);
                this.tasks = data;
            } else {
                this.tasks = this.computedTasks;
                console.log('else文の処理');
            }
        }
    },
 */
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

