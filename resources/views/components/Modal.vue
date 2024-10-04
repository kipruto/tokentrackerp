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
          <div class="mb-4">
            <label for="taskName" class="block text-sm font-medium text-gray-700">Task Name</label>
            <input v-model="taskName" type="text" id="taskName" placeholder="Task name" class="w-full p-2 border border-gray-300 rounded-md" />
          </div>

          <!-- Task Items -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Task Items</label>
            <div v-for="(item, index) in taskItems" :key="index" class="flex items-center space-x-2 mb-2">
              <input type="checkbox" v-model="item.done" class="h-4 w-4 text-blue-500 border-gray-300 rounded" />
              <input v-model="item.name" type="text" placeholder="Task item" class="w-full p-2 border-b border-gray-300 rounded-md" />
              <button @click="removeTaskItem(index)" class="rounded-lg"><i class="fad fa-minus text-red-500"></i></button>
            </div>
            <button @click="addTaskItem" class="bg-blue-500 text-white px-3 py-1 rounded-lg">+ Add Item</button>
          </div>

          <!-- Assign to Admin -->
          <div class="mb-4">
            <label for="assignedAdmin" class="block text-sm font-medium text-gray-700">Assign to Admin</label>
            <select v-model="assignedAdmin" id="assignedAdmin" class="w-full p-2 border border-gray-300 rounded-md">
              <option v-for="admin in admins" :key="admin.id" :value="admin.id">{{ admin.name }}</option>
            </select>
          </div>

          <!-- Task Budget -->
          <div class="mb-4">
            <label for="budget" class="block text-sm font-medium text-gray-700">Budget Allocated</label>
            <input v-model="budget" type="text" id="budget" placeholder="$50" class="w-full p-2 border border-gray-300 rounded-md" />
          </div>

          <!-- Task Status -->
          <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Current Status</label>
            <select v-model="status" id="status" class="w-full p-2 border border-gray-300 rounded-md">
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
          <div class="flex flex-col space-y-2 w-full mt-5">
            <button @click="saveTask" class="bg-blue-500 text-white rounded-lg px-4 py-2 w-full">Save Changes</button>
            <button @click="closeModal" class=" text-gray-900 rounded-lg px-4 py-2 w-1/3 mx-auto">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import { ref } from "vue";

  export default {
    name: 'TaskModal',
    props: {
      isModalOpen: Boolean,
    },
    setup(props, { emit }) {
      const taskName = ref("");
      const taskItems = ref([{ name: "", done: false }]);
      const assignedAdmin = ref("");
      const budget = ref("");
      const status = ref("");
      const comment = ref("");
      const admins = ref([
        { id: 1, name: "Admin 1" },
        { id: 2, name: "Admin 2" },
      ]);

      const closeModal = () => {
        emit("close");
      };

      const addTaskItem = () => {
        taskItems.value.push({ name: "", done: false });
      };

      const removeTaskItem = (index) => {
        taskItems.value.splice(index, 1);
      };

      const saveTask = () => {
        // Save task logic here
        console.log("Task Name:", taskName.value);
        console.log("Task Items:", taskItems.value);
        console.log("Assigned Admin:", assignedAdmin.value);
        console.log("Budget:", budget.value);
        console.log("Status:", status.value);
        console.log("Comment:", comment.value);

        closeModal();
      };

      return {
        taskName,
        taskItems,
        assignedAdmin,
        budget,
        status,
        comment,
        admins,
        closeModal,
        addTaskItem,
        removeTaskItem,
        saveTask,
      };
    },
  };
  </script>

  <style scoped>
  .bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
  }
  </style>
