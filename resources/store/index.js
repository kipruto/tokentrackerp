// store/index.js
import { createStore } from "vuex";
import axios from 'axios';

export default createStore({
    state: {
        user: null, // Store the logged-in user's info
        workspace: {
            workspace_id: null,
            workspace_name: null,
            workspace_description: null,
            access_token: null,
        },
        tasks: {
            backlog : [],
            inprogress : [],
            revision : [],
            done : []
        },
        taskForm: {
            task_title: "",
            task_items: [{ name: "", completed: false }],
            assigned_to: "",
            assignedto_name: "",
            budget_allocated: "",
            current_status: "backlog",
            comment: ""
        },
        admins: [],
        workspaces: []
    },
    mutations: {

        setUser(state, user) {
            state.user = user;
        },

        fetchWorkspace(state, workspace){
            state.workspace.workspace_id = workspace.id;
            state.workspace.workspace_name = workspace.workspace_name;
            state.workspace.workspace_description = workspace.workspace_description;
            state.workspace.access_token = workspace.access_token;
        },
        fetchWorkspaces(state, workspaces){
            state.workspaces = workspaces;
        },
        setTasks(state, tasks) {
            state.tasks.backlog = tasks.backlog;
            state.tasks.inprogress = tasks.inprogress;
            state.tasks.revision = tasks.revision;
            state.tasks.done = tasks.done;
        },
        clearTasks(state){
            state.tasks =  {
                backlog : [],
                inprogress : [],
                revision : [],
                done : []
            };
        },
        setTaskTitle(state, task_title) {
            state.taskForm.task_title = task_title;
        },
        setTaskItems(state, task_items) {
            state.taskForm.task_items = task_items;
        },
        setAssignedTo(state, assigned_to) {
            state.taskForm.assigned_to = assigned_to;
        },
        setBudgetAllocated(state, budget_allocated) {
            state.taskForm.budget_allocated = budget_allocated;
        },
        setCurrentStatus(state, current_status) {
            state.taskForm.current_status = current_status;
        },
        setComment(state, comment) {
            state.taskForm.comment = comment;
        },
        resetTaskForm(state) {
            state.taskForm = {
                task_title: "",
                task_items: [{ name: "", completed: false }],
                assigned_to: "",
                assignedto_name: "",
                budget_allocated: "",
                current_status: "backlog",
                comment: ""
            };
        },
        setAdmins(state, admins) {
            state.admins = admins;
        },
        clearUser(state) {
            state.user = null; // Clear the user info (for logout, etc.)
        },

    },
    actions: {
        login({ commit }, user) {
            commit("setUser", user); // Set the user after successful login
        },

        logout({ commit }) {
            commit("clearUser"); // Call the clearUser mutation
        },

        async fetchWorkspace({commit}, id){
            try {
                const response = await axios.get(`/api/workspaces/${id}'`);
                commit("fetchWorkspace", response.data);
            } catch (error) {
                console.log('Error getting the workspace:', error);
            }
        },

        async fetchWorkspaces({commit}){
            try {
                const response = await axios('/api/workspaces')
                commit('fetchWorkspaces', response.data)
            } catch (error) {
                console.log('Error getting workspaces:', error);
            }
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

        async fetchAdmins({ commit }) {
            try {
                const response = await axios.get('/api/fetchadmins');
                commit('setAdmins', response.data);
            } catch (error) {
                console.error("Error fetching admins:", error);
            }
        },


        async createTask({ commit }, taskData) {
            try {
                const response = await axios.post('/api/createtask', taskData);
                commit('setTasks', response.data);
            } catch (error) {
                console.error("Error creating task:", error);
                throw error;
            }
        }


    },
    getters: {
        isAuthenticated: (state) => !!state.user,
        isLoggedIn: (state) => !!state.user, // Check if user is logged in
        getUser: (state) => state.user,
        getAdmins: (state) => state.admins,
        getWorkspaceID: (state) => state.workspace.workspace_id,
    },
});
