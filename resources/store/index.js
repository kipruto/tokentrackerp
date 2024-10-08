// store/index.js
import { createStore } from "vuex";

export default createStore({
    state: {
        user: null, // Store the logged-in user's info
        workspaceid: null, // Store the workspaceID
        tasks: [],
    },
    mutations: {
        setUser(state, user) {
            state.user = user; // Update the user state
        },
        setWorkspaceID(state, workspaceid) {
            state.workspaceid = workspaceid; // Update the user state
        },
        clearUser(state) {
            state.user = null; // Clear the user info (for logout, etc.)
        },
        clearWorkspaceID(state) {
            state.workspaceid = null; // Clear the user info (for logout, etc.)
        },
        fetchTasks(state) {
            state.tasks = tasks; // Clear the user info (for logout, etc.)
        },
    },
    actions: {
        login({ commit }, user) {
            commit("setUser", user); // Set the user after successful login
        },
        clearworkspaceid({ commit }, workspaceid) {
            commit("clearWorkspaceID", workspaceid); // Set the user after successful login
        },
        setworkspaceid({ commit }, workspaceid) {
            commit("setWorkspaceID", workspaceid); // Set the workspace after successful login
        },
        logout({ commit }) {
            commit("clearUser"); // Call the clearUser mutation
        },
        async fetchTasks({ commit }, workspaceId) {
            try {
                const response = await axios.get(
                    `/api/workspaces/${workspaceId}/tasks`
                );
                commit("setTasks", response.data); // Commit the fetched tasks
            } catch (error) {
                console.error("Error fetching tasks:", error);
            }
        },
    },
    getters: {
        isAuthenticated: (state) => !!state.user,
        isLoggedIn: (state) => !!state.user, // Check if user is logged in
        getUser: (state) => state.user, // Get the logged-in user info
        getWorkspaceID: (state) => state.workspaceid,
    },
});
