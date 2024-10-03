<template>
    <div>
      <Navbar />

      <!-- start wrapper -->
      <div class="h-screen flex flex-row flex-wrap">
        <Sidebar />

        <!-- start content -->
        <div class="bg-gray-50 flex-1 p-6 md:mt-16">

            <div class="mx-4 min-h-screen max-w-screen-xl sm:mx-8 xl:mx-auto bg-white px-20 py-10 shadow-md rounded-md">
              <h1 class="border-b py-6 text-3xl font-semibold">Settings</h1>
              <div class="grid grid-cols-8 pt-3 sm:grid-cols-10">
                <div class="col-span-8 overflow-hidden rounded-xl  sm:px-8 sm:shadow">
                <!-- Render settings pages here -->
                <div class="w-full my-3">
                  <ul class="flex space-x-4 border-b pt-4">
                  <router-link to="/settings" class="cursor-pointer px-4 py-2 font-semibold text-gray-700 transition hover:border-b-blue-700 hover:text-blue-700" active-class="bg-blue-50 border-blue-500 text-blue-500"> General Settings </router-link>

                  <router-link to="/settings/roles" class="cursor-pointer px-4 py-2 font-semibold text-gray-700  transition hover:border-b-blue-700 hover:text-blue-700" > Roles & Permissions </router-link>

                  <router-link to="/settings/billingtokens" class="cursor-pointer px-4 py-2 font-semibold text-gray-700  transition hover:border-b-blue-700 hover:text-blue-700" > Billings& Tokens</router-link>

                  <router-link to="/settings/notifications" class="cursor-pointer px-4 py-2 font-semibold text-gray-700  transition hover:border-b-blue-700 hover:text-blue-700" > Notifications </router-link>

                  <router-link to="/settings/integrations" class="cursor-pointer px-4 py-2 font-semibold text-gray-700  transition hover:border-b-blue-700 hover:text-blue-700" > API & Integrations </router-link>
                  </ul>
                </div>

                <router-view></router-view>
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
  import Navbar from '../layouts/Navbar.vue'
  import Sidebar from '../layouts/Sidebar.vue'
  import Footer from '../layouts/Footer.vue'

  export default {
    name: 'Settings',
    components: {
      Navbar,
      Sidebar,

      Footer
    },


  }
  </script>

  <script>

</script>

