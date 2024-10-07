<template>
<div>
    <Navbar />

    <!-- start wrapper -->
    <div class="h-screen flex flex-row flex-wrap">
        <Sidebar />

        <!-- start content -->
        <div class="bg-white flex-1 p-6 md:mt-16">

            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ workspace_name }}</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="items-center flex justify-between md:divide-x md:divide-gray-100 dark:divide-gray-700 mb-10">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-3xl dark:text-white">{{workspace_name}} Workspace</h1>
                <button @click="openModal" id="createTaskButton" class="text-white bg-blue-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                    + Add New Task & Budget
                </button>
            </div>
            <TaskModal :isModalOpen="isModalOpen" @close="closeModal" />

            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="container mx-auto">
                        <!-- Kanban Board -->
                        <div class="grid grid-cols-5 gap-2">
                            <!-- Backlog Column -->
                            <div class="bg-kanban p-4 rounded-lg h-screen">
                                <span class="flex flex-row items-center mb-5">
                                    <i class="fad fa-circle text-black-500 mr-4"></i>
                                    <h3 class="text-md font-bold">Backlog</h3>
                                </span>
                                <div class="space-y-4 border-t border-gray-300" id="backlogColumn ">
                                    <!-- Task cards will be populated here dynamically -->
                                </div>
                            </div>

                            <!-- In Progress Column -->
                            <div class="bg-kanban p-4 rounded-lg h-screen">
                                <span class="flex flex-row items-center mb-5">
                                    <i class="fad fa-circle text-blue-500 mr-4"></i>
                                    <h3 class="text-md font-bold">In-Progress</h3>
                                </span>
                                <div class="space-y-4 border-t border-blue-200" id="inProgressColumn">
                                    <!-- Task cards will be populated here dynamically -->
                                </div>
                            </div>
                            <!-- Done Column -->
                            <div class="bg-kanban p-4 rounded-lg h-screen">
                                <span class="flex flex-row items-center mb-5">
                                    <i class="fad fa-circle text-red-500 mr-4"></i>
                                    <h3 class="text-md font-bold">Revision</h3>
                                </span>
                                <div class="space-y-4 border-t border-red-200" id="doneColumn">
                                    <!-- Task cards will be populated here dynamically -->
                                </div>
                            </div>
                            <!-- Done Column -->
                            <div class="bg-kanban p-4 rounded-lg h-screen">
                                <span class="flex flex-row items-center mb-5">
                                    <i class="fad fa-circle text-green-500 mr-4"></i>
                                    <h3 class="text-md font-bold">Done</h3>
                                </span>
                                <div class="space-y-4 border-t border-green-200" id="doneColumn">
                                    <!-- Task cards will be populated here dynamically -->
                                </div>
                            </div>

                            <!-- Add New Task Column -->
                            <div class="bg-gray-200 p-4 rounded-lg h-screen flex justify-center items-center cursor-pointer" id="newTaskButton">
                                <h1 class="text-xl font-bold capitalize text-gray-400">+ NEW TASK</h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end content -->
    </div>
    <!-- end wrapper -->

    <Footer />
</div>
</template>

<script>
import Navbar from '../layouts/Navbar.vue';
import Sidebar from '../layouts/Sidebar.vue';
import Footer from '../layouts/Footer.vue';
import TaskModal from "../components/Modal.vue";

import {
    ref
} from 'vue';
import axios from 'axios';

export default {
    props: ['id', 'workspacename'],
    name: 'Dashboard',
    components: {
        Navbar,
        Sidebar,
        Footer,
        TaskModal

    },

    setup() {
        const workspace = ref({});
        const workspace_name = ref("");
        const isModalOpen = ref(false);
        const openModal = ref(false);
        const closeModal = ref(false);

        return {
            workspace,
            workspace_name,
            isModalOpen,
            openModal,
            closeModal,
        }

    },
    computed: {

    },
    mounted() {
        this.fetchWorkspace(this.id);
    },
    methods: {
        async fetchWorkspace(id) {
            try {
                const response = await axios.get(`/api/workspaces/${id}`);
                this.workspace = response.data;
                this.workspace_name = response.data.workspace_name;

            } catch (error) {
                console.error('Error fetching workspace:', error);
            }
        },

        openModal() {

            this.isModalOpen = true; // Set the modal to open

        },
        closeModal() {
            this.isModalOpen = false; // Set the modal to close
        },

    }
}
</script>
