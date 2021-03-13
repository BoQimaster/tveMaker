import { createStore } from 'vuex'

export default createStore({
  state: {
    user: {},

  },
  mutations: {
    setUser(state, value) {
      state.user = value
    }
  },
  actions: {
  },
  modules: {
  }
})
