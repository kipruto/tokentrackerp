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
                    <input v-model="projectName" type="text" placeholder="Enter project name" class="w-full p-2 border rounded focus:outline-none" />
                </div>

                <!-- Project Type -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Project Type</label>
                    <select v-model="projectType" class="w-full p-2 border rounded focus:outline-none">
                        <option value="Internal">Internal</option>
                        <option value="External">External</option>
                    </select>
                </div>

                <!-- Client Name (conditional based on project type) -->
                <div v-if="projectType === 'External'" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Client Name</label>
                    <select v-model="clientId" class="w-full p-2 border rounded focus:outline-none">
                        <option v-for="client in clients" :key="client.id" :value="client.id">
                            {{ client.name }}
                        </option>
                        <option value="new">Add New Client</option>
                    </select>
                    <!-- If selecting "Add New Client" -->
                    <div v-if="clientId === 'new'" class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">New Client Name</label>
                        <input v-model="newClientName" type="text" placeholder="Enter client name" class="w-full p-2 border rounded focus:outline-none" />
                    </div>
                </div>

                <!-- Start Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input v-model="startDate" @change="validateDates" type="date" class="w-full p-2 border rounded focus:outline-none" />
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input v-model="deadline" @change="validateDates" type="date" class="w-full p-2 border rounded focus:outline-none" />
                </div>
                <p v-if="dateError" class="text-red-600 text-sm my-1">{{ dateError }}</p>
                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select v-model="status" class="w-full p-2 border rounded focus:outline-none">
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="On Hold">On Hold</option>
                    </select>
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
            </form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['isAddProjectModalOpen', 'clients'],
    emits: ['close', 'submit'],
    data() {
        return {
            projectName: '',
            projectType: 'Internal', // default to 'Internal'
            clientId: '',
            newClientName: '',
            startDate: '',
            deadline: '',
            status: 'Active',
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
        submitProject() {
            if (this.dateError) return;
            const projectPayload = {
                name: this.projectName,
                type: this.projectType,
                client_id: this.clientId === 'new' ? this.newClientName : this.clientId,
                start_date: this.startDate,
                deadline: this.deadline,
                status: this.status,
            };
            this.$emit('submit', projectPayload);
            this.closeAddProjectModal();
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
