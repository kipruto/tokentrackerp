<template>
    <div>
      <h2 class="text-xl font-semibold mb-4">Manage User Roles</h2>

      <!-- Table and dropdown for managing roles, same as before -->
      <table class="min-w-full bg-white shadow-md rounded mb-4">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Role</th>
            <th class="px-4 py-2">Change Role</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="border-b">
            <td class="px-4 py-2">{{ user.name }}</td>
            <td class="px-4 py-2">{{ user.email }}</td>
            <td class="px-4 py-2">
              <span :class="getRoleClass(user.role)">
                {{ user.role }}
              </span>
            </td>
            <td class="px-4 py-2">
              <select
                v-model="user.role"
                @change="changeUserRole(user)"
                class="block w-full p-2 border rounded-md"
              >
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        users: [],
      };
    },
    methods: {
      // Fetch the users from the API (like before)
      async fetchUsers() {
        const response = await fetch('/api/users');
        this.users = await response.json();
      },
      // Change user role
      async changeUserRole(user) {
        await fetch('/api/users/change-role', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ userId: user.id, role: user.role }),
        });
      },
    },
    mounted() {
      this.fetchUsers();
    },
  };
  </script>

  <style scoped>
  /* Scoped styles for Roles page */
  </style>
