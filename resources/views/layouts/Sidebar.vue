<template>
<!-- start sidebar -->
<div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
    <!-- sidebar content -->
    <div class="flex flex-col">
        <!-- sidebar toggle -->
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
        <!-- end sidebar toggle -->
        <p class="uppercase text-md text-gray-600 mb-4 tracking-wider">
            home
        </p>
        <!-- link -->
        <a href="/dashboard" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-chart-pie text-md mr-2"></i>
            dashboard
        </a>
        <!-- end link -->
        <p class="uppercase text-md text-gray-600 mb-4 mt-4 tracking-wider">
            my workspaces
        </p>
        <!-- link -->

        <!-- link -->
        <li v-for="workspace in workspaces" :key="workspace.id" class="list-none">
            <router-link :to="{ name: 'workspace', params: { id: workspace.id }, props: { workspace_name: workspace.workspace_name }}" class="my-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fas fa-folder text-md mr-2"></i>
                {{ workspace.workspace_name }}
            </router-link>
        </li>
        <a href="/createworkspace" class="my-3 capitalize font-medium text-md hover:text-teal-600 transition ease-in-out duration-500 text-blue-500">
            + New Workspace
        </a>

        <p class="uppercase text-md text-gray-600 mb-4 mt-4 tracking-wider">
            Tools
        </p>
        <!-- link -->

        <!-- link -->
        <a href="/timesheets" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-history text-md mr-2"></i>timesheets
        </a>
        <!-- end link -->
        <!-- link -->
        <a href="/invoices" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-file-invoice-dollar text-md mr-2"></i>
            invoices
        </a>
        <!-- end link -->
        <p class="uppercase text-md text-gray-600 mb-4 mt-4 tracking-wider">
            my apps
        </p>
        <!-- link -->
        <a href="/wallet" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-usd-circle mr-2"></i>
            My Wallet
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="/mynotes" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-shield-check text-md mr-2"></i>
            my notes
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="/calendar" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-calendar-edit text-md mr-2"></i>
            calendar
        </a>
        <!-- end link -->

        <p class="uppercase text-md text-gray-600 mb-4 mt-4 tracking-wider">
            Settings
        </p>
        <a href="/settings" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fas fa-cog text-md mr-2"></i>
            Settings
        </a>
    </div>
    <!-- end sidebar content -->
</div>
<!-- end sidbar -->
</template>

<script>
import axios from "axios";
import {
    ref
} from 'vue';

export default {
    name: "SideBar",
    setup() {
        const workspaces = ref([]);

        return {
            workspaces,
        };
    },

    async mounted() {
        await this.fetchWorkspaces();
    },

    methods: {
        async fetchWorkspaces() {
            try {
                const response = await axios.get("/api/workspaces");
                this.workspaces = response.data;
            } catch (error) {
                console.error("Error fetching workspaces:", error);
            }
        },
    },
};
</script>
