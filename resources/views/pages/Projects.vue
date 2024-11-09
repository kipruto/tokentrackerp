<template>
<div>
    <Navbar />

    <div class="flex flex-row flex-wrap bg-gray-200">
        <Sidebar />

        <!-- Main content area -->
        <div class="md:mt-16 flex-1 my-8 mx-auto p-20 bg-white card max-w-[83%]">
            <!-- Page title and add project button -->
            <div class="items-center flex justify-between md:divide-x md:divide-gray-100 dark:divide-gray-700 border-b-2 pb-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Projects Overview</h1>
            </div>

            <AddProjectModal  :clients="clients" :isAddProjectModalOpen="isAddProjectModalOpen" @close="closeAddProjectModal" />
            <!-- Top status cards -->

            <!-- Current projects table -->
            <div v-if="noProjects">
                <div class="grid grid-cols-5 gap-4 my-6">
                    <StatusCard label="Incoming" count="0" :index="0" />
                    <StatusCard label="Ongoing" count="0" :index="1" />
                    <StatusCard label="On Hold" count="0" :index="2" />
                    <StatusCard label="Completed" count="0" :index="3" />
                    <StatusCard label="Cancelled" count="0" :index="5" />
                </div>

                <!-- Resource cards with routing to respective pages -->
                <div class="grid grid-cols-4 gap-4 mb-10 bg-gray-200 p-5 rounded-md">
                    <ResourceCard title="Generate Report" icon="fas fa-file-alt" route="/reports" />
                    <ResourceCard title="Read Client Ethics" icon="fas fa-user-shield" route="/client-ethics" />
                    <ResourceCard title="Project Handbook" icon="fas fa-book" route="/company-handbook" />
                    <ResourceCard title="2024 Financial Plan" icon="fas fa-chart-line" route="/financial-plan" />
                </div>

                <div class="max-w-4xl mx-auto px-10  bg-white ">
                    <div class="flex flex-col justify-center py-6 items-center">
                        <div class="flex justify-center items-center">
                            <img class="w-52 h-40" src="https://res.cloudinary.com/daqsjyrgg/image/upload/v1690257804/jjqw2hfv0t6karxdeq1s.svg" alt="image empty states">
                        </div>
                        <h1 class="text-gray-900 font-bold text-2xl text-center mb-3">No Project Found!</h1>
                        <p class="text-gray-500 text-center mb-6">Create new projects and add team members.</p>
                        <div class="flex flex-col justify-center">
                            <button @click="openAddProjectModal" class="text-white bg-blue-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                + Create New Project
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="flex flex-col card mb-10">

                <div class="grid grid-cols-5 gap-4 my-6">
                    <StatusCard label="Incoming" count="0" :index="0" />
                    <StatusCard label="Ongoing" count="3" :index="1" />
                    <StatusCard label="On Hold" count="2" :index="2" />
                    <StatusCard label="Completed" count="10" :index="3" />
                    <StatusCard label="Cancelled" count="2" :index="5" />
                </div>

                <!-- Resource cards with routing to respective pages -->
                <div class="grid grid-cols-4 gap-4 mb-10 bg-gray-200 p-5 rounded-md">
                    <ResourceCard title="Generate Report" icon="fas fa-file-alt" route="/reports" />
                    <ResourceCard title="Read Client Ethics" icon="fas fa-user-shield" route="/client-ethics" />
                    <ResourceCard title="Project Handbook" icon="fas fa-book" route="/company-handbook" />
                    <ResourceCard title="2024 Financial Plan" icon="fas fa-chart-line" route="/financial-plan" />
                </div>
                <div class="items-center flex justify-between md:divide-x md:divide-gray-100 dark:divide-gray-700 mb-5">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Projects</h1>
                    <button @click="openAddProjectModal" class="text-white bg-blue-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        + Add New Project
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                <thead class=" dark:bg-gray-700 bg-gray-200">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" @change="selectAll($event)" />
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Project Name
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Client
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Deadline
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    <tr v-for="project in projects" :key="project.id" class="hover:bg-gray-100 dark:hover:bg-gray-700 project-table">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-{{ project.id }}" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" v-model="selectedProjects" />
                                                <label for="checkbox-{{ project.id }}" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-2 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <a href="/projectdetails/{{ project.id }}" class="text-sm text-gray-900 dark:text-white cursor-pointer">
                                                {{ project.project_name }}
                                            </a>
                                        </td>
                                        <td class="px-2 text-sm text-gray-900 whitespace-nowrap dark:text-white"><i class="fas fa-user text-gray-500 p-2 text-xs bg-gray-100 rounded-full mr-2"></i> {{ project.client_name }}</td>
                                        <td class="px-2 text-sm text-gray-900 whitespace-nowrap dark:text-white">{{ project.deadline }}</td>
                                        <td class="px-2 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                            <span :class="getStatusClass(project.status)" class="px-3 py-1 rounded-full text-xs font-semibold">{{ project.status }}</span>
                                        </td>
                                        <td class="flex px-2 py-1 space-x-2 whitespace-nowrap items-center justify-center">
                                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center border rounded-lg text-blue-500 hover:bg-blue-200 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                View
                                            </button>
                                            <button @click="deleteProject(project.id)" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                                <i class="fad fa-trash text-xs mr-2"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex flex-col justify-center items-center w-full my-5 border-t pt-4">
                                <Pagination :total-pages="totalPages" :current-page="currentPage" @page-changed="fetchProjects" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Navbar from '../components/partials/Navbar.vue'
import Sidebar from '../components/partials/Sidebar.vue'
import Footer from '../components/partials/Footer.vue'
import Pagination from '../components/navigation/Pagination.vue';
import AddProjectModal from "../components/modals/AddProjectModal.vue";
import axios from 'axios';
import StatusCard from './project_pages/subcomponents/TaskStatus.vue';
import ResourceCard from './project_pages/subcomponents/ResourceCard.vue';

import {
    ref
} from 'vue';

export default {
    components: {
        Navbar,
        Sidebar,
        Footer,
        AddProjectModal,
        Pagination,
        StatusCard,
        ResourceCard
    },
    data() {
        return {
            projects: ref([]), // State for projects list
            selectedProjects: [],
            completedProjects: ref([]),
            currentPage: 1,
            clients: [{ id: 1, name: 'Client A' }, { id: 2, name: 'Client B' }],
            totalPages: 0,
            noProjects: false,
            isAddProjectModalOpen: false,
            newProject: {
                name: '',
                client: '',
            },
            statusCounts: {
                active: 5,
                inactive: 3,
                cancelled: 2,
                completed: 10
            },

        };

    },
    mounted() {
        this.fetchProjects();
    },
    methods: {
        // Fetch projects from API
        async fetchProjects(page = 1, perPage = 10) {
            try {
                const response = await axios.get(`/api/projects`, {
                    params: {
                        page: 1,
                        perPage: 10
                    }
                });
                this.projects = response.data.data;
                this.currentPage = response.data.current_page;
                this.totalPages = response.data.last_page;
                this.noProjects = this.projects.length === 0;
            } catch (error) {
                console.error('Error fetching projects:', error);
            }
        },

        // Open modal to add a new project
        openAddProjectModal() {
            this.isAddProjectModalOpen = true;
        },

        // Close the modal and reset the form
        closeAddProjectModal() {
            this.isAddProjectModalOpen = false;
            this.newProject = {
                name: '',
                client: ''
            }; // Reset modal form
        },

        // Submit the new project to the server
        submitNewProject(projectPayload) {
            axios.post('/api/projects', projectPayload)
                .then((response) => {
                    this.projects.unshift(response.data.project);
                    this.closeAddProjectModal();
                })
                .catch((error) => {
                    console.error('Error creating project:', error);
                });
        },

        // Delete the project
        deleteProject(projectId) {
            if (confirm('Are you sure you want to delete this project?')) {
                // Optimistically remove the project from the list
                this.projects = this.projects.filter(project => project.id !== projectId);

                // Send delete request to backend
                axios.delete(`/api/projects/${projectId}`)
                    .then(() => {
                        console.log('Project deleted');
                    })
                    .catch((error) => {
                        console.error('Error deleting project:', error);
                        // If delete fails, restore the project back to the list
                        this.fetchProjects();
                    });
            }
        },

        // Other methods like goToProjectOverview, goToMemberPage, etc.
        goToProjectOverview(projectId) {
            this.$router.push({
                name: 'ProjectOverview',
                params: {
                    id: projectId
                }
            });
        },

        goToMemberPage(memberId) {
            this.$router.push({
                name: 'MemberProfile',
                params: {
                    id: memberId
                }
            });
        },

        getStatusClass(status) {
            return {
                'bg-blue-500 text-white': status === 'Active',
                'bg-green-500 text-white': status === 'Completed',
                'bg-red-500 text-white': status === 'Inactive',
                'bg-yellow-500 text-white': status === 'Pending',
                'bg-yellow-500 text-white': status === 'Cancelled',
            }
        },

        selectAll(event) {
            const isChecked = event.target.checked;
            this.selectedProjects = isChecked ? this.projects.map(project => project.id) : [];
        },
    },
};
</script>

<style scoped>
.project-table {
    padding: 10px !important;
}
</style>
