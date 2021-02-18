import { createStore } from 'vuex'



export default createStore({
  state: {
    adminInfo: {
      id: '',
      nickname: '',
      avatar: '',
    }

  },
  mutations: {
    getInfo(state, value) {
      state.adminInfo.id = value.id
      state.adminInfo.nickname = value.nickname
      state.adminInfo.avatar = value.avatar
    }
  },
  actions: {
  },
  modules: {
  }
})
