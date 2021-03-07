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
            <el-form :model="loginForm" status-icon :rules="rules" ref="loginForm" label-width="80px" label-position="left">
              <el-card>
                <el-form-item label="用户名" prop="name">
                  <el-input v-model.trim="loginForm.name" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                  <el-input type="password" v-model.trim="loginForm.password" autocomplete="off">
                    <template #append v-if="reset.show">
                      <el-button type="warning" @click="dialog = true">重置</el-button>
                    </template>
                  </el-input>
                </el-form-item>
                <el-form-item label="验证码" prop="captcha">
                  <el-input v-model.trim="loginForm.captcha" autocomplete="off" id="captcha">
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
                    <el-checkbox label="下次自动登录" v-model="loginForm.cookie" autocomplete="off"></el-checkbox>
                  </el-col>
                </el-form-item>
                <el-form-item label-width="0">
                  <el-row >
                    <el-col>
                      <el-button type="primary" @click="submitForm('loginForm')">登录</el-button>
                    </el-col>
                  </el-row>
                </el-form-item>
              </el-card>
            </el-form>
          </el-col>
        </el-row>
      </div>
      <!--密码重置抽屉开始-->
      <el-drawer title="密码重置" direction="btt" size="100%" :destroy-on-close="true" v-model="dialog">
          <!--步骤条-->
          <el-steps align-center :active="active">
            <el-step title="检查身份" :status="steps.step1"></el-step>
            <el-step title="验证信息" :status="steps.step2"></el-step>
            <el-step title="修改密码" :status="steps.step3"></el-step>
          </el-steps>
            <!--检查账户信息-->
            <el-form v-if="checkFormDisplay" :model="checkForm" :rules="ruleCheck" ref="checkForm" :label-width="formLabelWidth" class="checkForm">
              <el-form-item label="用户名" prop="username">
                <el-input v-model="checkForm.username" class="checkInput" placeholder="请输入用户名"></el-input>
                <el-button type="info" @click="getMail" class="checkButton">检查用户名</el-button>
              </el-form-item>
              <p>{{ checkMessage }}</p>
              <el-form-item label="邮箱" prop="email">
                <el-input type="email" :disabled="emailDisabled" v-model="checkForm.email" class="checkInput"></el-input>
                <el-button type="primary" :disabled="buttonDisabled" class="checkButton" @click="getCaptcha">
                  {{ sendEmailCaptcha }}
                </el-button>
              </el-form-item>
            </el-form>
            <!--验证邮箱验证码-->
            <el-form v-if="captchaFormDisplay" :model="captchaForm" :rules="ruleCaptcha" ref="captchaForm" :label-width="formLabelWidth" class="checkForm">
            <el-form-item label="验证码" prop="captcha">
              <el-input v-model="captchaForm.captcha" placeholder="请输入收到的验证码" class="checkInput"></el-input>
              <el-button type="primary" @click="checkCaptcha" class="checkButton">检查验证码</el-button>
            </el-form-item>
            </el-form>
          <!--修改密码-->
          <el-form v-if="resetFormDisplay" :model="resetForm" :rules="rulePassword" ref="resetForm" :label-width="formLabelWidth" class="checkForm">
            <el-form-item label="用户名" prop="username">
              <el-input v-model="resetForm.username" disabled></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password">
              <el-input show-password type="password" v-model="resetForm.password" placeholder="请输入新密码"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="passwordChecked">
              <el-input show-password type="password" v-model="resetForm.passwordChecked" placeholder="请确认新密码"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="warning" @click="resetPassword">重置密码</el-button>
            </el-form-item>
          </el-form>
      </el-drawer>
      <!--密码重置抽屉结束-->
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
/*密码重置css*/
.checkForm {
  width: 34rem;
  margin: 8rem auto;
}
.checkInput {
  width: 18rem;
}
.checkButton {
  margin-left: 2rem;
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
import {  login, post } from "@/http/api";
import { ElMessage } from 'element-plus';
import { checkCookie, setCookie } from "@/http/cookie";


export default {
  name: 'Home',

  data() {
    // 验证新密码
    const validatePassword = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入新密码'));
      } else {
        if (this.resetForm.password !== '') {
          this.$refs.resetForm.validateField('checkPassword');
        }
        callback();
      }
    }
    // 验证确认新密码
    const validatePasswordChecked = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请再次输入新密码'));
      } else if (value !== this.resetForm.password) {
        callback(new Error('两次输入密码不一致!'));
      } else {
        callback();
      }
    }
    return {
      // 密码重置按钮数据
      reset:{
        show: false,
        count: 0,
      },
      // 验证码数据
      image:{
        url: '',
      },
      // 登录表单数据
      loginForm: {
        name: '',
        password: '',
        captcha: '',
        cookie: false,
        __token__: ''
      },
      // 登录信息检查规则
      rules: {
        name: [
          { required: true, message: '请输入用户名',trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入密码',trigger: 'blur' }
        ],
        captcha: [
          { required: true, message: '请输入验证码',trigger: 'blur' }
        ]
      },
      // 重置密码验证规则
      ruleCheck: {
        username: [
          { required: true, message: '请输入用户名',trigger: 'blur' }
        ],
        email: [
          { required: true, message: '请输入邮箱', trigger: 'blur' }
        ]
      },
      // 验证码验证规则
      ruleCaptcha: {
        captcha: [
          { required: true, message: '请输入验证码', trigger: 'blur' }
        ]
      },
      // 重置密码验证规则
      rulePassword: {
        password: [
          { validator: validatePassword, trigger: 'blur' }
        ],
        passwordChecked: [
          { validator: validatePasswordChecked, trigger: 'blur' }
        ]
      },
      // 步骤条数据
      steps: {
        step1: 'finish',
        step2: 'wait',
        step3: 'wait',
      },
      // 用户名检查表单
      checkFormDisplay: true,
      active: 1,
      dialog: false,
      // 用户名检查数据
      checkForm: {
        username: '',
        email: ''
      },
      formLabelWidth: '80px',
      emailDisabled: true,
      buttonDisabled: true,
      checkMessage: '',
      sendEmailCaptcha: '发送验证码',
      // 验证码表单
      captchaFormDisplay: false,
      captchaForm: {
        captcha: ''
      },
      // 密码重置表单
      resetFormDisplay: false,
      resetForm: {
        password: '',
        passwordChecked: '',
        username: ''
      }
    }
  },
  computed: {

  },
  methods: {
    // 重新获取验证码方法
    ref() {
      getYZ('/token').then(data => {
        this.loginForm.__token__ = data['token']
        this.image.url = data['captcha']
      })
    },
    // 三次错误后可以重置密码
    nextChange() {
      if (this.active <2 ) this.active ++
    },
    // 登录表单方法
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          login('/login_check', this.loginForm).then(data => {
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
          this.$message({
            type: 'error',
            message: '表单提交错误！',
            showClose: true
          })
          return false;
        }
      })
    },
    // 邮箱信息检查
    getMail() {
      if (this.checkForm.username === ''){
        this.$message.error('用户名不能为空')
      } else {
        post('/password/search', this.checkForm).then(data => {
          if (data.error) {
            this.$message.error(data.error)
          } else {
            this.emailDisabled = false
            this.buttonDisabled = false
            this.checkMessage = '请输入与' + data + '对应的邮箱获取验证码'
          }
        })
      }
    },
    // 获取邮箱验证码
    getCaptcha() {
      // 检查checkForm表单
      this.$refs['checkForm'].validate((valid) => {
        if (valid) {
          // 异步发送信息获取验证码
          if (this.checkForm.username === ''){
            this.$message.error('邮箱不能为空')
          } else {
            post('/password/send', this.checkForm).then(data => {
              if (data.error) {
                this.$message.error(data.error)
              } else {
                this.$message.success(data)
                // 发送验证码成功
                this.steps.step1 = 'success'
                this.steps.step2 = 'finish'
                this.checkFormDisplay = false
                this.captchaFormDisplay = true
                this.active = 2
              }
            })
            this.buttonDisabled = true
            let i=59
            setInterval(() => {
              if (i>0) {
                this.sendEmailCaptcha = i + '秒后获取'
                i--
              }
            }, 1000)
            setTimeout( () => {
              this.sendEmailCaptcha = ' 重发验证码 '
              this.buttonDisabled = false
            }, 60000)
          }
        } else {
          this.$message({
            type: 'error',
            message: '信息提交错误！',
            showClose: true
          })
          return false;
        }
      })
    },
    // 验证邮箱验证码
    checkCaptcha() {
      this.$refs['captchaForm'].validate((valid) => {
        if (valid) {
          // 邮箱验证码验证成功
          post('/password/check', this.captchaForm).then(data => {
            if (data.error) {
              this.$message.error(data.error)
            } else {
              this.$message.success(data)
              // 验证码验证成功
              this.steps.step2 = 'success'
              this.steps.step3 = 'finish'
              this.captchaFormDisplay = false
              this.resetFormDisplay = true
              this.resetForm.username = this.checkForm.username
              this.active = 3
            }
          })
        } else {
          // 邮箱验证码验证失败
          this.$message({
            type: 'error',
            message: '信息提交错误！',
            showClose: true
          })
          return false;
        }
      })
    },
    // 重置密码提交
    resetPassword() {
      this.$refs['resetForm'].validate((valid) => {
        if (valid) {
          // 重置密码验证成功
          post('/password/reset', this.resetForm).then(data => {
            if (data.error) {
              this.$message.error(data.error)
            } else {
              this.$message.success(data)
              // 密码修改成功
              this.steps.step3 = 'success'
              this.dialog = false
            }
          })
        } else {
          // 重置密码验证失败
          this.$message({
            type: 'error',
            message: '信息提交错误！',
            showClose: true
          })
          return false;
        }
      })
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
