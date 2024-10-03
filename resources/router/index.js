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
import NewWallet from "../views/pages/NewWallet.vue";
import Roles from "../views/pages/settings_pages/Roles.vue";
import Notifications from "../views/pages/settings_pages/Notifications.vue";
import BillingTokens from "../views/pages/settings_pages/BillingTokens.vue";
import Integrations from "../views/pages/settings_pages/Integrations.vue";
import AccountSettings from "../views/pages/settings_pages/AccountSettings.vue";

const isAuthenticated = () => {
    return !!localStorage.getItem("user"); // Example: Check if the user object exists in localStorage
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

            { path: "workspace", component: Workspace, name: "workspace" },
            {
                path: "manageusers",
                component: ManageUsers,
                name: "manageUsers",
            },

            { path: "timesheets", component: Timesheets, name: "timesheets" },

            { path: "taskboard", component: Kanban, name: "kanban" },

            { path: "wallet", component: Wallet, name: "wallet" },

            { path: "newwallet", component: NewWallet, name: "newwallet" },

            { path: "kanban", component: Kanban, name: "kanban" },

            { path: "calendar", component: Calendar, name: "calendar" },

            { path: "settings", component: Settings, name: "settings" },
        ],
    },

    {
        path: "/settings",
        component: Settings,
        children: [
            {
                path: "",
                component: AccountSettings,
            },

            {
                path: "roles",
                component: Roles,
            },

            {
                path: "billingtokens",
                component: BillingTokens,
            },

            {
                path: "integrations",
                component: Integrations,
            },

            {
                path: "notifications",
                component: Notifications,
            },
        ],
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
