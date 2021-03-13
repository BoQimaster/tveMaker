<template>
    <div class="upload">
      <el-container>
        <el-header>header</el-header>
        <el-main>
          <el-upload
              class="avatar-uploader"
              name="avatar"
              action="/admin_upload"
              :data="data"
              :show-file-list="false"
              :on-error="uploadError"
              :on-success="handleAvatarSuccess"
              :before-upload="beforeAvatarUpload">
            <img v-if="imageUrl" :src="imageUrl" class="avatar" />
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-main>
        {{data.id}}
        <el-footer>footer</el-footer>
      </el-container>
    </div>
</template>

<script>

import { mapState } from "vuex";
import { post } from "@/http/api";


export default {
name: "Upload",

  data() {
    return {
      imageUrl: '',
      data: {
        id: this.id
      }


    }
  },
  computed: {
    ...mapState({
      id: state => state.user.id
    })
  },
  methods: {
    uploadError(err){
      console.log(err)
    },
    handleAvatarSuccess(res, file) {
      if(res){
        console.log(res)
        this.imageUrl = URL.createObjectURL(file.raw);
      }
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error('上传头像图片只能是 JPG 格式!');
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!');
      }
      return isJPG && isLt2M;
    }
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
.avatar-uploader {
  width: 178px;
  height: 178px;
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  overflow: hidden;
}
.avatar-uploader:hover {
  border-color: #409EFF;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>