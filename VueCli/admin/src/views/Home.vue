<template>
  <div class="home">
    <div class="layout">
      <el-container>
        <el-header height="100px"></el-header>
        <!-- 登录UI-->
        <el-main>
          <el-row type="flex" justify="center">
            <el-col :xs="3" :sm="6" :md="7" :lg="8" :xl="9"></el-col>
            <el-col :xs="18" :sm="12" :md="10" :lg="8" :xl="6">
              <h2>登录信息</h2>
              <el-row>
                <el-col :span="24">
                  <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="80px" label-position="left">
                    <el-card>
                      <el-form-item label="用户名" prop="username">
                        <el-input v-model.trim="ruleForm.username" autocomplete="off"></el-input>
                      </el-form-item>
                      <el-form-item label="密码" prop="password">
                        <el-input type="password" v-model.trim="ruleForm.password" autocomplete="off"></el-input>
                      </el-form-item>
                      <el-form-item label="验证码" prop="captcha">
                        <el-input v-model.trim="ruleForm.captcha" autocomplete="off" id="captcha">
                          <template #append>
                            <div class="block" @click="refCaptcha">
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
                        <el-col :push="8"><el-link :underline="false" type="info" href="/changePassword">重置密码</el-link></el-col>
                      </el-form-item>
                      <el-form-item>
                        <el-row>
                          <el-col :pull="1">
                            <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                          </el-col>
                        </el-row>
                      </el-form-item>
                    </el-card>
                  </el-form>
                </el-col>
              </el-row>
            </el-col>
            <el-col :xs="3" :sm="6" :md="7" :lg="8" :xl="9"></el-col>
          </el-row>
        </el-main>
      </el-container>
    </div>
  </div>
</template>

<script>
import { getCaptcha } from "@/http/api";
import { login } from "@/http/api";
import { ElMessage } from 'element-plus';
import { checkCookie } from "@/http/cookie";
import { setCookie } from "@/http/cookie";


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
      image:{
        url: '',
      },
      ruleForm: {
        username: '',
        password: '',
        captcha: '',
        cookie: false,
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
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          login('/login_check', this.ruleForm).then(data => {
            try{
              if (data.id) {
                if(data.cookie === true) {
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
                for (const err of data) {
                  setTimeout(function() {
                    ElMessage({
                      showClose: true,
                      message: err,
                      type: 'error',
                    })
                  }, 50)
                }
              }
            } catch(err) {
              alert(err)
            }
          })
        } else {
          console.log('提交错误~');
          return false;
        }
      });
    },
    refCaptcha() {
      getCaptcha('/captcha').then(data => {
        this.image.url = data
      })
    }
  },
  // 加载页面之前初始化
  beforeCreate() {
    if (checkCookie('userData') || sessionStorage.key('userData')) {
      this.$router.push('/tveMaker')
    } else {
      getCaptcha('/captcha').then(data => {
        this.image.url = data
      })
    }
  }
}


</script>

<style scoped>
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