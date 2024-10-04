// store/index.js
import { createStore } from 'vuex';

export default createStore({
  state: {
    user: null, // Store the logged-in user's info
  },
  mutations: {
    setUser(state, user) {
      state.user = user; // Update the user state
    },
    clearUser(state) {
      state.user = null; // Clear the user info (for logout, etc.)
    },
  },
  actions: {
    login({ commit }, user) {
        commit('setUser', user); // Set the user after successful login
      },
    logout({ commit }) {
      commit('clearUser'); // Call the clearUser mutation
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.user,
    isLoggedIn: (state) => !!state.user, // Check if user is logged in
    getUser: (state) => state.user, // Get the logged-in user info
  },
});
