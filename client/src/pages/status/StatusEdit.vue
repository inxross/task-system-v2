<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header">ステータス編集画面</div>

                <div class="card-body">
                        ステータス名<br>
                        <input type="text" class="form-control" name="status_name" v-model="status.name">
                        <br>
                        <ul>
                            <div v-for="error in errors.status_name" :key="error.id">
                                <li class="errorMessage">{{error}}</li>
                            </div>
                        </ul>
                        <br>
                        <button class="btn btn-success" @click="update">更新する</button>
                    <!--{{category.name}}
                    <br>
                    {{category.id}}-->
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
            errors: {
                status_name: [],
            }
        };
    },
    computed: {
        status() {
            const dataId = parseInt(this.$route.params.id, 10);
            //const dataId = this.$route.params.id;
            const data = this.$store.getters.statusList.find(a => (
                a.id === dataId
            ));
            return data;
        }
    },
    methods: {
        update() {
            axios.post(
                '/api/status/update',
                {
                    status_name: this.status.name,
                    id: this.status.id
                }
            )
            .then(response => {
                console.log(response);
                this.$router.push({
                    name: "StatusIndex"
                });
            })
            .catch(error => {
                console.log(error.response.data.errors.status_name);
                if(error.response.data.errors.status_name) {
                    const errorsStatusName = error.response.data.errors.status_name;
                    this.errors.status_name = errorsStatusName.map((error) => {
                        return error
                    })
                }
            });

        },
    },
/*
    created() {
        //型確認
        console.log(typeof this.$route.params.id);
        const data = this.$store.state.categoryList.find(a => (
            a.id === this.$route.params.id
        ));
        console.log(typeof data.id);
    }
 */
}
</script>

<style>

</style>
