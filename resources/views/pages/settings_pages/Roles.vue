<template>
  <div class="bg-white flex-1 p-6">

    <div class="flex flex-col">
      <div class="overflow-x-auto">
          <div class="inline-block min-w-full align-middle">
              <div class="overflow-hidden shadow">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                      <thead class="bg-gray-100 dark:bg-gray-700">
                          <tr>
                              <th scope="col" class="p-4">
                                  <div class="flex items-center">
                                      <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                      <label for="checkbox-all" class="sr-only">checkbox</label>
                                  </div>
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                 ID
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Name
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                 Email Adress
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                              Current Role
                            </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                 Update Role/ Remove User
                              </th>

                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              <td class="w-4 p-4">
                                  <div class="flex items-center">
                                      <input id="checkbox-{{ .id }}" aria-describedby="checkbox-1" type="checkbox"
                                          class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                      <label for="checkbox-{{ .id }}" class="sr-only">checkbox</label>
                                  </div>
                              </td>
                              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                  <div class="text-base font-semibold text-gray-900 dark:text-white"> #{{ id }}U-123</div>

                              </td>

                              <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ name }} Enock Kipruto</td>
                              <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ emailaddress }}ropenock@gmail.com</td>
                              <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ currentRole }}SuperAdmin</td>

                              <td class="p-4 space-x-2 whitespace-nowrap flex items-center">
                                <div class="relative inline-block w-1/3 text-gray-700">
                                  <select
                                    v-model="selectedRole"
                                    @change="handleChange"
                                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                  >
                                    <option disabled selected value="">Select Role</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Regular User">Regular User</option>
                                  </select>
                                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z"/>
                                    </svg>
                                  </div>
                                </div>
                                  <button type="button" id="deleteProductButton" data-drawer-target="drawer-delete-product-default" data-drawer-show="drawer-delete-product-default" aria-controls="drawer-delete-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                      <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                      Remove User
                                  </button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
  </template>

  <script>
  export default {
    name: "Roles",
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
