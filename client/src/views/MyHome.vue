<template>
    <div>
        <h3>Home</h3>
        <button @click="toUsers">Usersのページに行く</button>
        <p>Vuexを用いたcountの値：{{ count }}</p>
        <button @click="increment">+1</button>
        <button @click="decrement">-1</button>
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
        },
        increment() {
            this.$store.state.count++;
        },
        decrement() {
            this.$store.state.count--;
        }
    }
}
</script>
