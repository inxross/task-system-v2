<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-nav>
            <b-navbar-brand class="mx-3" href="#">task_system</b-navbar-brand>
            </b-navbar-nav>

            <!-- Navbar dropdowns -->
            <b-navbar-nav class="ms-auto">
            <b-nav-item-dropdown text="設定" right>
                <b-dropdown-item :to="{ name: 'CategoryIndex' }">カテゴリ設定</b-dropdown-item>
                <b-dropdown-item :to="{ name: 'StatusIndex' }">ステータス設定</b-dropdown-item>
                <b-dropdown-item href="#">ユーザー設定</b-dropdown-item>
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

}
</script>

<style>

</style>
