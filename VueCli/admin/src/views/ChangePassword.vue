<template>
  <div class="changePassword">
    <h3>changePassword</h3>
    <h3>{{id}}</h3>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { checkCookie } from "@/http/cookie";
import { getCookie } from "@/http/cookie";

export default {
name: "ChangePassword",

  data() {
    return {
      id: ''
    }
  },
  computed: {

    ...mapState({

    })
  },
  // 加载之前初始化数据
  created() {
    if (checkCookie('userData')) {
      const userData = JSON.parse(getCookie('userData'))
      this.id = userData.id
    } else if (sessionStorage.key('userData')) {
      let userData = sessionStorage.getItem('userData')
      userData = JSON.parse(decodeURIComponent(userData))
      this.id = userData.id
    } else {
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>

</style>