<template>
    <div>
        <h3>Home</h3>
        <button @click="toUsers">Usersのページに行く</button>
        <p>Vuexを用いたcountの値：{{ count }}</p>
    </div>
</template>

<script>
export default {
    computed: {
        count() {
            return this.$store.state.count;
        }
    },
    methods: {
        toUsers() {
            this.$router.push({path: "users"});
        }
    }
}
</script>
