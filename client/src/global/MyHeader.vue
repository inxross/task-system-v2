<template>
<div v-if="this.$route.name === 'MyLogin'">
<LoginHeader />
</div>
<div v-else>
<DefaultHeader />
</div>
</template>

<script>
import DefaultHeader from "./header/DefaultHeader.vue";
import LoginHeader from "./header/LoginHeader.vue";

export default {
    components: {
        DefaultHeader,
        LoginHeader
    },
}
</script>

<style>

</style>
