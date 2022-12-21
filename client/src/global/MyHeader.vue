<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-nav>
            <b-navbar-brand class="mx-3" :to="{ name: 'TaskIndex' }">task_system</b-navbar-brand>
            <div class="form-inline" v-show="this.$route.name === 'TaskIndex'">

                <input class="me-2" type="search" placeholder="Search" aria-label="Search" v-model="searchword" v-on:input="search">

                <select class="mt-2 mx-1" v-model="categoryId" v-on:change="search">
                    <option value="0">カテゴリ選択</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <select class="mt-2 mx-1" v-model="statusId" v-on:change="search">
                    <option value="0" selected>ステータス選択</option>
                    <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
                </select>
                <select class="mt-2 mx-1" v-model="userId" v-on:change="search">
                    <option value="0" selected>ユーザー選択</option>
                    <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                </select>
                <!-- <button @click="test(1)">test</button> -->
                <!-- {{categories}} -->
                <!-- {{ categoryId }} -->
                <!-- {{searchword}} -->
            </div>
            </b-navbar-nav>

            <!-- Navbar dropdowns -->
            <b-navbar-nav class="ms-auto">
            <b-nav-item-dropdown text="設定" right>
                <b-dropdown-item :to="{ name: 'CategoryIndex' }">カテゴリ設定</b-dropdown-item>
                <b-dropdown-item :to="{ name: 'StatusIndex' }">ステータス設定</b-dropdown-item>
                <b-dropdown-item :to="{ name: 'UserIndex' }">ユーザー設定</b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item-dropdown text="User" right>
                <b-dropdown-item href="#">個人設定</b-dropdown-item>
                <b-dropdown-item href="#">Logout</b-dropdown-item>
            </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categoryId: '0',
            statusId: '0',
            userId: '0',
            searchword: '',
        };
    },
    computed: {
        categories() {
            return this.$store.getters.categoryList;
        },
        statuses() {
            return this.$store.getters.statusList;
        },
        users() {
            return this.$store.getters.userList;
        },
    },
    created() {
        this.$store.dispatch('updateCategoryList');
        this.$store.dispatch('updateStatusList');
        this.$store.dispatch('updateUserList');
        //console.log(this.$route.name);
    },
    methods: {
        search() {
            //console.log("searchを実行しました");
            this.$router.push({
                name: "TaskIndex",
                query: { category: this.categoryId, status: this.statusId, user: this.userId, searchword: this.searchword}
            })
            .catch( err => console.log(err) )
        },
/*
        test(id) {
            this.$router.push({
                name: "TaskIndex",
                query: { test: id}
            })
        },
 */
    }
}
</script>

<style>

</style>
