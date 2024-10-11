<template>
<div v-if="isModalOpen">
    <!-- Background Overlay -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40"></div>

    <!-- Pop-up Modal -->
    <div class="fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3 py-12 px-16 relative z-50">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Add New Task</h2>
                <button @click="closeModal" class="text-gray-500 hover:text-gray-800"><i class="fad fa-times text-gray-800"></i></button>
            </div>
            <!-- Task Name -->
            <div>
                <form @submit.prevent="addnewTask">
                    <div class="mb-4">
                        <label for="taskName" class="block text-sm font-medium text-gray-700">Task Title</label>
                        <input v-model="task_title" type="text" id="taskName" placeholder="Task name" class="w-full p-2 border border-gray-300 rounded-md" />
                    </div>
                    <!-- Task Items -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Task Items</label>
                        <div v-for="(item, index) in task_items" :key="index" class="flex items-center space-x-2 mb-2">
                            <input type="checkbox" v-model="item.completed" class="h-4 w-4 text-blue-500 border-gray-300 rounded" />
                            <input v-model="item.title" type="text" placeholder="Task item" class="w-full p-2 border-b border-gray-300 rounded-md" />
                            <button @click.prevent="removeTaskItem(index)" class="rounded-lg"><i class="fad fa-minus text-red-500"></i></button>
                        </div>
                        <button @click.prevent="addTaskItem" class="bg-blue-500 text-white px-3 py-1 rounded-lg">+ Add Item</button>
                    </div>

                    <!-- Assign to Admin -->
                    <div class="mb-4">
                        <label for="assignedAdmin" class="block text-sm font-medium text-gray-700">Assign to</label>
                        <select v-model="assigned_to" id="assignedAdmin" class="w-full p-2 border border-gray-300 rounded-md">
                            <option v-for="admin in admins" :key="admin.id" :value="admin.id">{{ admin.name }}</option>

                        </select>
                    </div>

                    <!-- Task Budget -->
                    <div class="mb-4">
                        <label for="budget" class="block text-sm font-medium text-gray-700">Budget Allocated (KES)</label>
                        <input v-model="budget_allocated" type="number" id="budget" placeholder="KES." class="w-full p-2 border border-gray-300 rounded-md" />
                    </div>

                    <!-- Task Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Current Status</label>
                        <select v-model="current_status" id="status" class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="backlog">Backlog</option>
                            <option value="inprogress">In Progress</option>
                            <option value="revision">Revision</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- Comment Box -->
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                        <textarea v-model="comment" id="comment" rows="3" placeholder="Enter your comment..." class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                    </div>

                    <!-- Attach File -->
                    <div class="mb-4">
                        <label for="attachFile" class="block text-sm font-medium text-gray-700">Attach File</label>
                        <input type="file" id="attachFile" class="w-full p-2 border border-gray-300 rounded-md" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col w-full my-5">
                        <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 w-full">Save New Task</button>
                    </div>
                </form>
                <div class="flex flex-col w-full">
                    <button @click="closeModal" class=" text-gray-900 rounded-lg px-4 w-1/3 mx-auto">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { ref, watch, computed } from "vue";
import { mapActions, mapGetters, mapState, useStore } from "vuex";
import axios from 'axios';

export default {
    name: 'TaskModal',
    props: {
        isModalOpen: {
            type: Boolean,
            required: true,
        }

    },
    setup(props, {
        emit
    }) {
        const store = useStore();
        const task_title = ref("");
        const task_items = ref([{
            name: "",
            completed: false
        }]);

        const assigned_to = ref("");
        const assignedto_name = ref("");
        const budget_allocated = ref("");
        const current_status = ref("backlog");
        const comment = ref("");
        const current_user = ref("");
        const current_username = ref("");
        const admins =ref([]);

        watch(() => props.isModalOpen, (newVal) => {
            if (!newVal) {
                resetForm();
            }
        });

        const resetForm = () => {
            task_title.value = "";
            task_items.value = [{
                name: "",
                completed: false
            }];
            assigned_to.value = "";
            assignedto_name.value = "";
            budget_allocated.value = "";
            comment.value = "";
        };

        return {
            current_user,
            current_username,
            task_title,
            task_items,
            assigned_to,
            assignedto_name,
            budget_allocated,
            current_status,
            comment,
            admins,
            store,
            resetForm,
            closeModal: () => emit('close'),
        };

    },
    mounted() {

        this.getAdmins();

        const storedUser = JSON.parse(localStorage.getItem('user'));
        if (storedUser) {
            this.current_user = storedUser.id;
            this.current_username = storedUser.name.split(' ')[0];
        }

    },

    computed: {

        ...mapState({
        workspace_id: state => state.workspace.workspace_id,
        admins: state => state.admins,

    }),


    },
    methods: {
        ...mapActions(['fetchAdmins', 'fetchTasks']),

        async getAdmins() {
            await this.store.dispatch('fetchAdmins');
            this.admins = this.store.state.admins;

        },

        async addnewTask() {

            try {

                const selectedAdmin = this.admins.find(admin => admin.id === this.assigned_to);

                const response = await axios.post('/api/createtask', {
                    task_title: this.task_title,
                    task_items: this.task_items,
                    assigned_to: this.assigned_to,
                    assignedto_name: selectedAdmin.name,
                    budget_allocated: this.budget_allocated,
                    current_status: this.current_status,
                    comment: this.comment,
                    created_by: this.current_user,
                    workspace_id: this.workspace_id
                });

                if (response.status === 200) {
                    alert("Task created successfully");
                    this.closeModal();
                    this.sendNotification();
                    await this.store.dispatch('fetchNotifications')
                    await this.store.dispatch('fetchTasks', this.workspace_id);
                }

            } catch (error) {
                if (error.response) {
                    console.error("Error Response:", error.response);
                    alert(`Server Error: ${error.response.data.message || 'Something went wrong!'}`);
                } else if (error.request) {
                    console.error("Error Request:", error.request);
                    alert("No response from server. Please try again.");
                } else {
                    console.error("Error Message:", error.message);
                    alert(`Error: ${error.message}`);
                }

            }

        },

        async sendNotification(){

            try {
                const response = await axios.post('/api/sendnotification', {
                    from : this.current_username,
                    to_userid:this.assigned_to,
                    title : "assigned you a new task",
                    budget_allocated : this.budget_allocated,
                    message: "Budget amount- ",
                    task_id: this.task_id,
                    workspace_id:this.workspace_id,
                    links:`/api/${this.workspace_id}/tasks/${this.task_id}`
            });

            if(response.status == 200){
                console.log('Notification Sent')
            }

            } catch (error) {
                if (error.response) {
                    console.error("Error Response:", error.response);
                    alert(`Server Error: ${error.response.data.message || 'Something went wrong!'}`);
                } else if (error.request) {
                    console.error("Error Request:", error.request);
                    alert("No response from server. Please try again.");
                } else {
                    console.error("Error Message:", error.message);
                    alert(`Error: ${error.message}`);
                }

            }

        },

        addTaskItem() {
            this.task_items.push({
                title: "",
                done: false
            });
        },

        removeTaskItem(index) {
            this.task_items.splice(index, 1);
        },

    }
};
</script>

<style scoped>
.bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
