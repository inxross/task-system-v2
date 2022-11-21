<template>
    <div style="width: 700px; margin: auto; padding-top: 50px;">
        <Header/>
        <br>
        <router-view/>
        <br>
        <Footer/>
    </div>
</template>

<script>
import Header from '@/global/MyHeader'
import Footer from '@/global/MyFooter'

export default {
  name: 'App',

  components: {
    Header,
    Footer
  },

  data: () => ({

  }),
};
</script>
