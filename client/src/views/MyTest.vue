<template>
    <div>
        <button @click="getData">Data取得</button>
        <p>{{person.name}}</p>
        <p>{{person.kana}}</p>
    </div>
</template>

<script>
import axios from 'axios';

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
            const response = await axios.get(
                '/api/mytest/test'
            )

            this.person = response.data.person;
        }
    }
}
</script>
