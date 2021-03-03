<template>
  <div class="home">
    <div class="layout">
      <div class="login-panel">
        <el-row type="flex" justify="center">
          <h2>登录信息</h2>
        </el-row>
        <!-- 登录UI-->
        <el-row type="flex" justify="center" align="middle">
          <el-col :span="24">
            <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="80px" label-position="left">
              <el-card>
                <el-form-item label="用户名" prop="username">
                  <el-input v-model.trim="ruleForm.username" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                  <el-input type="password" v-model.trim="ruleForm.password" autocomplete="off">
                    <template #append v-if="reset.show">
                      <el-button type="warning" @click="resetPassword">重置</el-button>
                    </template>
                  </el-input>
                </el-form-item>
                <el-form-item label="验证码" prop="captcha">
                  <el-input v-model.trim="ruleForm.captcha" autocomplete="off" id="captcha">
                    <template #append>
                      <div class="block" @click="ref">
                        <el-image :src="image.url" fit="cover" class="btn-image" style="border-radius: 0 4px 4px 0;">
                          <template #placeholder>
                            <div class="image-slot"><i class="el-icon-loading"></i></div>
                          </template>
                          <template #error>
                            <div class="image-slot"><i class="el-icon-picture-outline"></i></div>
                          </template>
                        </el-image>
                      </div>
                    </template>
                  </el-input>
                </el-form-item>
                <el-form-item prop="cookie">
                  <el-col>
                    <el-checkbox label="下次自动登录" v-model="ruleForm.cookie" autocomplete="off"></el-checkbox>
                  </el-col>
                </el-form-item>
                <el-form-item label-width="0">
                  <el-row >
                    <el-col>
                      <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                    </el-col>
                  </el-row>
                </el-form-item>
              </el-card>
            </el-form>
          </el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>

<style scoped>
html,body { height: 100%; }
.layout {
  height: 100%;
  position: relative;
}
.login-panel {
  width: 420px;
  position: relative;
  margin-left: auto;
  margin-right: auto;
}
.block {
  display: block;
  height: 38px;
  margin: 0 -20px;
}
.image-slot {
  margin: 10px 0;
}

@media all and (max-width: 768px) {
  .btn-image {
    width: 100px;
    height: 38px;
  }

}
@media all and (min-width: 769px) {
  .btn-image {
    width: 150px;
    height: 38px;
  }

}
</style>

<script>
import { getYZ } from "@/http/api";
import {  login } from "@/http/api";
import { ElMessage } from 'element-plus';
import { checkCookie, setCookie } from "@/http/cookie";


export default {
  name: 'Home',

  data() {
    const validateName = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入用户名'))
      } else {
        callback()
      }
    }
    const validatePass = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入密码'))
      } else {
        callback()
      }
    }
    const validateCaptcha = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入验证码'))
      } else {
        callback()
      }
    }
    return {
      reset:{
        show: false,
        count: 0,
      },
      image:{
        url: '',
      },
      ruleForm: {
        username: '',
        password: '',
        captcha: '',
        cookie: false,
        __token__: ''
      },
      rules: {
        username: [
          {
            validator: validateName,
            trigger: 'blur'
          }
        ],
        password: [
          {
            validator: validatePass,
            trigger: 'blur'
          }
        ],
        captcha: [
          {
            validator: validateCaptcha,
            trigger: 'blur'
          }
        ]
      }
    }
  },
  computed: {
    test() {
      return 'test'
    },
  },
  methods: {
    // 遗忘登录密码后重置
    resetPassword() {

    },
    ref() {
      getYZ('/token').then(data => {
        this.ruleForm.__token__ = data['token']
        this.image.url = data['captcha']
      })
    },
    submitForm: function (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          login('/login_check', this.ruleForm).then(data => {
            try {
              if (data.id) {
                if (data.cookie === true) {
                  delete data.cookie
                  this.$store.commit('getInfo', data)
                  let userData = JSON.stringify(data)
                  userData = encodeURIComponent(userData)
                  sessionStorage.setItem('userData', userData)
                  setCookie('userData', userData, 6, '/')
                } else {
                  this.$store.commit('getInfo', data)
                  let userData = JSON.stringify(data)
                  userData = encodeURIComponent(userData)
                  sessionStorage.setItem('userData', userData)
                }
                this.$message.success('验证成功！欢迎 ' + data.nickname)
                setTimeout(() => this.$router.push('/tveMaker'), 1000)
              } else {
                if (this.reset.count === 2) this.reset.show = true
                for (let err of data) {
                  if (err === '用户名或密码错误~') {
                    this.reset.count += 1
                  }
                  setTimeout(function () {
                    ElMessage({
                      showClose: true,
                      message: err,
                      type: 'error',
                    })
                  }, 50)
                  this.ref()
                }
              }
            } catch (err) {
              alert(err)
            }
          })
        } else {
          console.log('提交错误~');
          return false;
        }
      });
    }
  },
  // 加载页面之前初始化
  created() {
    if (checkCookie('userData') || sessionStorage.key('userData')) {
      this.$router.push('/tveMaker')
    } else {
      this.ref()
    }
  }
}


</script>
