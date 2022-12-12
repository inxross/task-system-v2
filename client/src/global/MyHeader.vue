<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-nav>
            <b-navbar-brand class="mx-3" :to="{ name: 'TaskIndex' }">task_system</b-navbar-brand>
            <div class="form-inline" v-show="this.$route.name === 'TaskIndex'">
                <select class="mt-2" v-model="categoryId" v-on:change="categorySearch">
                    <option value="0" selected>カテゴリ選択</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <!-- <button @click="test(1)">test</button> -->
                <!-- {{categories}} -->
                <!-- {{ categoryId }} -->
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
        };
    },
    computed: {
        categories() {
            return this.$store.getters.categoryList;
        },
    },
    created() {
        this.$store.dispatch('updateCategoryList');
        console.log(this.$route.name);
    },
    methods: {
        categorySearch() {
            //console.log("categorySearchを実行しました");
            this.$router.push({
                name: "TaskIndex",
                query: { category: this.categoryId}
            })
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
