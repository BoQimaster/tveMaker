<template>
  <div class="home">
      <div class="layout">
        <el-container>

<!-- 登录UI-->
          <el-main>
              <el-row type="flex">
                  <el-col :xs="3" :sm="6" :md="7" :lg="8" :xl="9"></el-col>
                  <el-col :xs="18" :sm="12" :md="10" :lg="8" :xl="6">
                      <h2>登录信息</h2>
                      <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="80px" label-position="left">
                        <el-card>
                          <el-form-item label="用户名" prop="name">
                              <el-input type="text" v-model.trim="ruleForm.name" autocomplete="off"></el-input>
                          </el-form-item>
                          <el-form-item label="密码" prop="password">
                            <el-input type="password" v-model.trim="ruleForm.password" autocomplete="off"></el-input>
                          </el-form-item>
                          <el-form-item label="验证码" prop="captcha">
                            <el-input v-model.trim="ruleForm.captcha">
                              <template #append>
                                <el-button @click="refCaptcha" class="block" style="padding: 10px 0;">
                                  <el-image v-bind:src="ruleForm.url" fit="cover">
                                    <template #placeholder>
                                      <div class="image-slot"><i class="el-icon-loading"></i></div>
                                    </template>
                                    <template #error>
                                      <div class="image-slot"><i class="el-icon-picture-outline"></i></div>
                                    </template>
                                  </el-image>
                                </el-button>
                              </template>
                            </el-input>
                          </el-form-item>
                          <el-form-item prop="checkCookie">
                            <el-checkbox label="下次自动登录" v-model="ruleForm.checkCookie"></el-checkbox>
                          </el-form-item>
                          <el-form-item>
                            <el-row>
                              <el-col :span="12">
                                <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                              </el-col>
                              <el-col :span="12">
                                <el-button @click="resetForm('ruleForm')">重置</el-button>
                              </el-col>
                            </el-row>
                          </el-form-item>
                        </el-card>
                      </el-form>
                  </el-col>
                <el-col :xs="3" :sm="6" :md="7" :lg="8" :xl="9"></el-col>
              </el-row>
          </el-main>


        </el-container>
      </div>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  name: 'Home',

  data() {
    var validateName = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入用户名'))
      } else {
        callback()
      }
    }
    var validatePass = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入密码'))
      } else {
        if (this.ruleForm.checkPass !== '') {
          this.$refs.ruleForm.validateField('checkPass');
        }
        callback()
      }
    }
    var validateCaptcha = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请输入验证码'))
      } else {
        callback()
      }
    }
    return {
      ruleForm: {
        url: 'http://api.tvemaker.com/captcha',
        name: '',
        password: '',
        captcha: '',
        checkCookie: false,
      },
      rules: {
        name: [
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
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
            axios.post('http://admin.tvemaker.com/login_check', this.ruleForm)
                .then(function(response) {
                  console.log(response)
                })
                .catch(function(error) {
                  console.log(error)
                })
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    refCaptcha() {
       axios({
         method: 'get',
         url: '/captcha',
         responseType: 'arraybuffer'
       }).then(res => {
         return 'data:image/png;base64,' + btoa(new Uint8Array(res.data).reduce((data, byte) => data + String.fromCharCode(byte), '')
         )
       }).then(data => {
         this.ruleForm.url = data
       })


    }
  }
}
</script>

<style>
@media all and (max-width: 768px) {
  .el-image {
    width: 100px;
    height: 35px;
  }
}
@media all and (min-width: 769px) {

.el-image {
  width: 150px;
  height: 35px;
}
.el-header {
  background-color: #dd6161;
}
.el-main {
  /*background-color: #42b983;*/
}
.el-footer {
  background-color: #00ffff;
}

}
</style>