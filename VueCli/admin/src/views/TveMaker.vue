<template>
  <div class="tveMaker">
    <el-container>
      <el-header>
        <el-row type="flex">
              <el-col :span="12">
                <el-row>
                  TVEMaker
                </el-row>
              </el-col>
              <el-col :span="12">
                  <el-row type="flex" justify="end">
                    <div class="block">
                      <span>你好，{{nickname}}</span>
                    </div>
                    <div class="block">
                      <el-dropdown>
                        <el-avatar class="avatar el-dropdown-link" shape="square" :size="50" :src="avatar" @error="errorHandler">
                          <i class="el-icon-user-solid"></i>
                        </el-avatar>
                        <template #dropdown>
                          <el-dropdown-menu>
                            <el-dropdown-item @click="logoutDialogVisible = true"><i class="el-icon-switch-button"></i>退出登录</el-dropdown-item>
                          </el-dropdown-menu>
                        </template>
                      </el-dropdown>
                      <el-dialog v-model="logoutDialogVisible">
                          <span>确定要退出吗?</span>
                        <template #footer>
                            <span class="dialog-footer">
                              <el-button @click="logoutDialogVisible = false">取 消</el-button>
                              <el-button type="primary" @click="logout">确 定</el-button>
                            </span>
                        </template>
                      </el-dialog>
                    </div>
                  </el-row>
              </el-col>
        </el-row>
      </el-header>
      <el-container>
        <el-aside width="200px">Aside</el-aside>
        <el-container>
          <el-main>Main</el-main>
          <el-footer>Footer</el-footer>
        </el-container>
      </el-container>
    </el-container>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { post } from "@/http/api";

export default {
  name: "TveMaker",

  data() {
    return {
      logoutDialogVisible: false,

    }
  },
  computed: {

    ...mapState({
      nickname: state => state.user.nickname,
      avatar:   state => state.user.avatar
    })
  },
  methods: {
    errorHandler() {
      return true
    },
    logout() {
      // 登出
      this.$router.push('/')
    },

  },
  // 路由初始化
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
.block{
  display: block;
  margin-left: 20px;
}
.avatar {
  position: relative;
  margin-top: 5px;
}
.el-header, .el-footer {
  background-color: #B3C0D1;
  color: #333;
  text-align: center;
  line-height: 60px;
}

.el-aside {
  background-color: #D3DCE6;
  color: #333;
  text-align: center;
  line-height: 200px;
}

.el-main {
  background-color: #E9EEF3;
  color: #333;
  text-align: center;
  line-height: 160px;
}
</style>