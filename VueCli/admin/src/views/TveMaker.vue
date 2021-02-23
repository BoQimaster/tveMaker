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
                      <el-avatar class="avatar" shape="square" :size="50" :src="avatar" @error="errorHandler">
                      <i class="el-icon-user-solid"></i>
                    </el-avatar></div>
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

export default {
  name: "TveMaker",

  data() {
    return {

    }
  },
  computed: mapState({
    nickname: state => state.adminInfo.nickname,
    avatar: state => state.adminInfo.avatar
  }),
  methods: {
    errorHandler() {
      return true
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