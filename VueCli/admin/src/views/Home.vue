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
                <el-form-item label="用户名" prop="name">
                  <el-input v-model.trim="ruleForm.name" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                  <el-input type="password" v-model.trim="ruleForm.password" autocomplete="off">
                    <template #append v-if="reset.show">
                      <el-button type="warning" @click="dialog = true">重置</el-button>
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
      <!--密码重置-->
      <el-drawer title="密码重置" direction="btt" size="100%" :destroy-on-close="true" :before-close="handleClose" :show-close="false" v-model="dialog">
        <div>
          <el-steps class="passwordSteps" align-center :active="active" direction="horizontal">
            <el-step title="验证身份" status="process"></el-step>
            <el-step title="修改密码" status="wait"></el-step>
          </el-steps>
          <el-card class="passwordCard">
            <el-form :model="resetForm"  status-icon :rules="rulePassword" ref="resetForm" :label-width="formLabelWidth" class="passwordForm">
              <el-form-item label="用户名" prop="username">
                <el-input v-model="resetForm.username" class="passwordInput" placeholder="请输入用户名"></el-input>
                <el-button type="info" @click="getMail" style="margin-left: 20px; right: 0;">检查用户名</el-button>
              </el-form-item>
              <p>{{ resetMessage }}</p>
              <el-form-item label="邮箱" prop="email">
                <el-input type="email" v-model="resetForm.email" :disabled="resetEmail" class="passwordInput" placeholder="请输入邮箱"></el-input>
                <el-button :disabled="resetDisabled" v-model="resetDisabled" type="warning" @click="getCaptcha" style="margin-left: 20px; right: 0;">
                  {{ resetButton }}</el-button>
              </el-form-item>
              <el-form-item label="验证码" prop="captcha2">
                <el-input v-model="resetForm.captcha2" :disabled="resetCaptcha" placeholder="请输入收到的验证码"></el-input>
              </el-form-item>
            </el-form>
          </el-card>
          <div class="passwordSubmit">
            <el-button @click="cancelForm">取 消</el-button>
            <el-button type="primary" @click="resetPassword('resetForm')" :loading="loading">{{ loading ? '提交中 ...' : '确 定' }}</el-button>
          </div>
        </div>
      </el-drawer>
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
/*密码重置*/
.passwordCard {
  width: 550px;
  margin: 50px auto;
  display: block;
}
.passwordForm {
  float: left;
  margin: 0 auto;
}
.passwordInput {
  width: 250px;
}
.passwordSubmit {
  margin-top: 50px;
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
    let validateName = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入用户名'))
      } else {
        callback()
      }
    }
    let validatePass = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入密码'))
      } else {
        callback()
      }
    }
    let validateCaptcha = (rule, value, callback) => {
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
        name: '',
        password: '',
        captcha: '',
        cookie: false,
        __token__: ''
      },
      rules: {
        name: [
          { validator: validateName, trigger: 'blur' }
        ],
        password: [
          { validator: validatePass, trigger: 'blur' }
        ],
        captcha: [
          { validator: validateCaptcha, trigger: 'blur' }
        ],
      },
      // 重置密码验证规则
      rulePassword: {
        username: [
          { required: true, message: '请输入用户名',trigger: 'blur' }
        ],
        email: [
          { required: true, message: '请输入邮箱', trigger: 'blur' }
        ],
        captcha2: [
          { required: true, message: '请输入验证码', trigger: 'blur' }
        ]
      },
      // 重置密码数据
      active: 1,
      dialog: true,
      loading: false,
      resetForm: {
        username: '',
        email: '',
        captcha2: ''
      },
      resetEmail: true,
      resetDisabled: true,
      resetMessage: '',
      resetButton: '发送验证码',
      resetCaptcha: true,
      formLabelWidth: '80px'
    }
  },
  computed: {

  },
  methods: {
    ref() {
      getYZ('/token').then(data => {
        this.ruleForm.__token__ = data['token']
        this.image.url = data['captcha']
      })
    },
    submitForm(formName) {
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
          this.$message({
            type: 'error',
            message: '表单提交错误！',
            showClose: true
          })
          return false;
        }
      })
    },
    // 重置密码
    getMail() {
      if (this.resetForm.username === ''){
        this.$message.error('用户名不能为空')
      } else {
        post('/password/search', this.resetForm).then(data => {
          if (data.error) {
            this.$message.error(data.error)
          } else {
            this.resetEmail = false
            this.resetDisabled = false
            this.resetMessage = '请输入与' + data + '对应的邮箱获取验证码'
          }
        })
      }
    },
    getCaptcha() {
      // 异步发送信息获取验证码
      if (this.resetForm.username === ''){
        this.$message.error('邮箱不能为空')
      } else {
        post('/password/send', this.resetForm).then(data => {
          if (data.error) {
            this.$message.error(data.error)
          } else {
            this.$message.success(data)
            this.resetCaptcha = false
          }
        })
        this.resetDisabled = true
        let i=59
        setInterval(() => {
          if (i>0) {
            this.resetButton = i + '秒后获取'
            i--
          }
        }, 1000)
        setTimeout( () => {
          this.resetButton = '重新发送'
          this.resetDisabled = false
        }, 60000)
      }
    },
    nextChange() {
      if (this.active <2 ) this.active ++
    },
    resetPassword(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          return true;
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
    handleClose() {
      // 关闭拟态窗之前
      return true;
    },
    // 取消修改密码
    cancelForm() {
      this.loading = false;
      this.dialog = false;
      clearTimeout(this.timer);
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
