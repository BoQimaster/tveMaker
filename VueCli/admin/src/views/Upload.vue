<template>
    <div class="upload">
      <el-container>
        <el-header>header</el-header>
        <el-main>
          <el-upload
              class="avatar-uploader"
              name="avatar"
              action="http://api.tvemaker.com/admin_upload"
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
import { checkCookie } from "@/http/cookie";
import { getCookie } from "@/http/cookie";


export default {
name: "Upload",

  data() {
    return {
      imageUrl: '',
      data: {
        id: ''
      }


    }
  },
  computed: {
    ...mapState({

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
    if (checkCookie('userData')) {
      const userData = JSON.parse(getCookie('userData'))
      this.data.id = userData.id
    } else if (sessionStorage.key('userData')) {
      let userData = sessionStorage.getItem('userData')
      userData = JSON.parse(decodeURIComponent(userData))
      this.data.id = userData.id
    } else {
      this.$router.push('/')
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