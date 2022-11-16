<template>
    <div>
        <button @click="getData">Data取得</button>
        <p>{{person.name}}</p>
        <p>{{person.kana}}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            person: {
                name: '',
                kana: '',
            },
        };
    },
    methods: {
        async getData() {
            const response = await this.axios.get('http://vue-laravel-separately-tasksystem.localdomain/api/mytest');
            this.person = response.data.person;
        }
    }
}
</script>
