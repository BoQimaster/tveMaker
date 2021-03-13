<template>
  <div class="changePassword">
    <h3>changePassword</h3>
    <h3>{{id}}</h3>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import {post} from "@/http/api";

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
    const token = localStorage.getItem('token')
    if( token === '') {
      this.$router.push('/')
    } else {
      post('/admin/check','', token).then(data => {
        // token验证成功
        // 保存登录信息到vueX
        this.$store.commit('setUser', data)
      }).catch(err => {
        // token验证失败
        localStorage.removeItem('token')
        err.message = 'Token已过期，请重新登录'
        this.$router.push('/')
        this.$message.error(err.message)
      })
    }
  }
}
</script>

<style scoped>

</style>