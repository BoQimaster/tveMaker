import { createStore } from 'vuex'

export default createStore({
  state: {
    userData: ''

  },
  mutations: {
    getInfo(state, value) {
      state.userData = value
    }
  },
  actions: {
  },
  modules: {
  }
})
