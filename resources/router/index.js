// src/router/index.js

import { createRouter, createWebHistory } from "vue-router";
import Login from "../views/pages/Login.vue";
import Dashboard from "../views/pages/Dashboard.vue";
import Timesheets from "../views/pages/Timesheets.vue";
import Calendar from "../views/pages/Calendar.vue";
import Settings from "../views/pages/Settings.vue";
import Workspace from "../views/pages/Workspace.vue";
import ManageUsers from "../views/pages/ManageUsers.vue";
import Kanban from "../views/pages/Kanban.vue";
import Wallet from "../views/pages/Wallet.vue";
import ResetPassword from "../views/pages/ResetPassword.vue";
import CreateWorkspace from "../views/pages/CreateWorkspace.vue";
import ServerError404 from "../views/pagesError/404.vue";
import ServerError500 from "../views/pagesError/500.vue";
import store from "../store";
import Notes from "../views/pages/Notes.vue";


const isAuthenticated = () => {
    return store.getters.isAuthenticated;
};

const routes = [
    {
        path: "/",
        redirect: (to) => {
            if (isAuthenticated()) {
                return { name: "dashboard" };
            }
            return { name: "login" };
        },
    },

    {
        path: "/login",
        component: Login,
        name: "login",
    },

    {
        path: "/reset",
        component: ResetPassword,
        name: "resetpassword",
    },

    {
        path: "/:catchAll(.*)",
        redirect: "/404",
    },

    {
        path: "/404",
        component: ServerError404,
        meta: { requiresAuth: false },
    },

    {
        path: "/",
        meta: { requiresAuth: true }, // Indicate that these routes require authentication
        children: [
            {
                path: "/dashboard",
                component: Dashboard,
                name: "dashboard",
            },

            {
                path: "createworkspace",
                component: CreateWorkspace,
                name: "createworkspace",
            },

            {
                path: '/workspaces/:id',
                component: Workspace,
                name: 'workspace',
                props: route => ({ id: route.params.id, workspace_name: route.params.workspace_name })
                // props: true, // Enables the route to pass the :id param as a prop to the Workspace component
            },

            {
                path: "mynotes",
                component: Notes,
                name: "mynotes",
            },

            {
                path: "manageusers",
                component: ManageUsers,
                name: "manageUsers",
            },

            { path: "timesheets", component: Timesheets, name: "timesheets" },

            { path: "taskboard", component: Kanban, name: "kanban" },

            { path: "wallet", component: Wallet, name: "wallet" },

            { path: "kanban", component: Kanban, name: "kanban" },

            { path: "calendar", component: Calendar, name: "calendar" },

            { path: "settings", component: Settings, name: "settings" },
        ],
    },

    {
        path: "/settings",
        component: Settings,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard to check for authentication
router.beforeEach((to, from, next) => {
    // If the route requires authentication and the user is not authenticated, redirect to /login
    if (
        to.matched.some((record) => record.meta.requiresAuth) &&
        !isAuthenticated()
    ) {

        next({ name: "login" });
    } else {

        next(); // Proceed as normal
    }
});

export default router;
