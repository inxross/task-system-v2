<template>
    <div class="card">
        <div class="card-header">ステータス管理画面</div>

        <div class="card-body">

            <button v-on:click="create" class="btn btn-outline-primary">
                新規登録
            </button>

            <table class="table table-hover my-2">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">ステータス名</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">更新日</th>
                    </tr>
                </thead>
                <tbody v-for="status in statuses" :key="status.id">
                <tr>
                    <th>{{status.id}}</th>
                    <td>{{status.name}}</td>
                    <td><button class="btn btn-outline-success" @click="goEdit(status.id)">編集</button></td>
                    <td><button class="btn btn-outline-danger" @click="goDestroy(status.id)">削除</button></td>
                    <td>{{status.updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

    computed: {
        statuses() {
            return this.$store.getters.statusList;
        }
    },
    created() {
        this.$store.dispatch('updateStatusList');
    },
    methods: {
        create() {
            this.$router.push({
                name: "StatusCreate"
            });
        },
        goEdit(id) {
            this.$router.push({
                name: "StatusEdit",
                params: { id: id}
            })
        },
        goDestroy(id) {
            this.$router.push({
                name: "StatusDestroy",
                params: { id: id}
            })
        },
    }

}
</script>

<style>

</style>
