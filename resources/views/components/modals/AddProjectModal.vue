<template>
<div v-if="isAddProjectModalOpen">
    <!-- Background Overlay -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40" @click="closeAddProjectModal"></div>

    <!-- Sliding Panel -->
    <div class="fixed top-0 right-0 h-full bg-white shadow-lg transition-transform duration-300 transform z-50" :class="{'translate-x-0': isAddProjectModalOpen, 'translate-x-full': !isAddProjectModalOpen}" style="width: 30%;">
        <div class="py-8 px-12 mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Add New Project</h2>
                <button @click="closeAddProjectModal" class="text-gray-500 hover:text-gray-800">
                    <i class="fas fa-times text-gray-800"></i>
                </button>
            </div>

            <form @submit.prevent="submitProject" class="mt-10">
                <!-- Project Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Project Name</label>
                    <input v-model="projectName" type="text" placeholder="Enter project name" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required  />
                    <p v-if="errors.project_name" class="text-red-600 text-sm my-1">{{ errors.project_name[0] }}</p>
                </div>

                <!-- Project Type -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Project Type</label>
                    <select v-model="projectType" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required >
                        <option value="Internal">Internal</option>
                        <option value="External">External</option>
                    </select>
                    <p v-if="errors.project_type" class="text-red-600 text-sm my-1">{{ errors.project_type[0] }}</p>
                </div>

                <!-- Client Name (conditional based on project type) -->
                <div v-if="projectType === 'External'" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Client Name</label>
                    <select v-model="clientId" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required >
                        <option v-for="client in clients" :key="client.id" :value="client.id">
                            {{ client.name }}
                        </option>
                        <option value="new">Add New Client</option>
                    </select>
                    <!-- If selecting "Add New Client" -->
                    <div v-if="clientId === 'new'" class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">New Client Name</label>
                        <input v-model="newClientName" type="text" placeholder="Enter client name" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required  />
                    </div>
                    <p v-if="errors.client_id" class="text-red-600 text-sm my-1">{{ errors.client_id[0] }}</p>
                    <p v-if="errors.new_client_name" class="text-red-600 text-sm my-1">{{ errors.new_client_name[0] }}</p>
                </div>

                <!-- Start Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input v-model="startDate" @change="validateDates" type="date" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required  />
                    <p v-if="errors.start_date" class="text-red-600 text-sm mt-1">{{ errors.start_date[0] }}</p>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input v-model="deadline" @change="validateDates" type="date" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required  />
                </div>
                <p v-if="dateError" class="text-red-600 text-sm my-1">{{ dateError }}</p>

                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select v-model="status" class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-500" required >
                        <option value="incoming">Incoming</option>
                        <option value="in_progress">In Progress</option>
                        <option value="on_hold">On Hold</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <p v-if="errors.status" class="text-red-600 text-sm my-1">{{ errors.status[0] }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 justify-between mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">
                        Add Project
                    </button>
                    <button @click="closeAddProjectModal" class="text-gray-900 bg-gray-200 px-4 py-2 rounded w-full">
                        Cancel
                    </button>
                </div>

                <!-- Display server-side validation errors after submitting -->
                <div v-if="formErrors" class="mt-4 text-red-600">
                    <p v-for="(error, field) in formErrors" :key="field" class="text-sm">{{ error[0] }}</p>
                </div>
            </form>

        </div>
    </div>
</div>
</template>


<script>

import {
    ref
} from 'vue';

export default {
    props: ['isAddProjectModalOpen', 'clients'],
    emits: ['close', 'submit'],
    data() {
        return {
            projects: ref([]),
            projectName: '',
            clients: [{ id: 1, name: 'Client A' }, { id: 2, name: 'Client B' }],
            projectType: 'Internal', // default to 'Internal'
            clientId: '',
            newClientName: '',
            startDate: '',
            deadline: '',
            status: 'incoming',
            errors: {},
            formErrors: null,
            newProject: {
                name: '',
                client: '',
            },
        };
    },
    methods: {
        validateDates() {
            if (this.startDate && this.deadline) {
                if (this.deadline < this.startDate) {
                    this.dateError = 'Deadline cannot be earlier than the start date.';
                } else {
                    this.dateError = ''; // Clear error if dates are valid
                }
            }
        },
        closeAddProjectModal() {
            this.$emit('close');
        },
        async submitProject() {
            if (this.dateError) return;
            const projectPayload = {
                project_name: this.projectName,
                project_type: this.projectType,
                client_id: this.clientId === 'new' ? this.newClientName : this.clientId,
                start_date: this.startDate,
                deadline: this.deadline,
                status: this.status,
            };
            try {
                const response = await axios.post('/api/projects', projectPayload).then((response) => {
                    this.projects.unshift(response.data.project);
                    this.closeAddProjectModal();
                });
                this.$emit('submit', response.data);
                this.closeAddProjectModal();
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    this.formErrors = error.response.data.errors;
                }
            }
        },
    },
    watch: {
        startDate() {
            this.validateDates();
        },
        deadline() {
            this.validateDates();
        },
    },
};
</script>

<style scoped>
/* Styles for slide-in animation */
.translate-x-full {
    transform: translateX(100%);
}

.translate-x-0 {
    transform: translateX(0);
}
</style>
