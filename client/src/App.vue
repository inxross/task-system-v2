<template>
    <div style="padding-top: 30px;">
        <b-container>
            <Header/>
            <br>
            <router-view/>
            <br>
        </b-container>
    </div>
</template>

<script>
import Header from '@/global/MyHeader'

export default {
  name: 'App',

  components: {
    Header,
  },

  data: () => ({

  }),
};
</script>
