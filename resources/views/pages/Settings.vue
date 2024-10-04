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
                    <li @click="setActiveTab('accountsettings')" class="cursor-pointer px-4 py-2 font-semibold" :class="{ 'text-blue-500 border-b-blue-700 border-b bg-blue-50 border-blue-500 ': isActiveTab('accountsettings') }">AccountSettings</li>

                    <li @click="setActiveTab('roles')" class="cursor-pointer px-4 py-2 font-semibold" :class="{ 'text-blue-500 border-b-blue-700 border-b bg-blue-50 border-blue-500': isActiveTab('roles') }">Roles & Permissions</li>

                    <li @click="setActiveTab('billingtokens')" class="cursor-pointer px-4 py-2 font-semibold" :class="{ 'text-blue-500 border-b-blue-700 border-b bg-blue-50 border-blue-500': isActiveTab('billingtokens') }">Billings & Tokens</li>

                    <li @click="setActiveTab('notifications')" class="cursor-pointer px-4 py-2 font-semibold" :class="{ 'text-blue-500 border-b-blue-700 border-b bg-blue-50 border-blue-500': isActiveTab('notifications') }">Notifications</li>

                    <li @click="setActiveTab('integrations')" class="cursor-pointer px-4 py-2 font-semibold" :class="{ 'text-blue-500 border-b-blue-700 border-b bg-blue-50 border-blue-500': isActiveTab('integrations') }">API & Integration</li>

                  </ul>
                </div>
                <component :is="activeTabComponent"></component>
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
import roles from "../pages/settings_pages/Roles.vue";
import notifications from "../pages/settings_pages/Notifications.vue";
import billingtokens from "../pages/settings_pages/BillingTokens.vue";
import integrations from "../pages/settings_pages/Integrations.vue";
import accountsettings from "../pages/settings_pages/AccountSettings.vue";

  export default {
    name: 'Settings',
    components: {
      Navbar,
      Sidebar,
      Footer,
      accountsettings,
      roles,
      billingtokens,
      notifications,
      integrations,
    },
    data() {
      return {
        activeTab: 'accountsettings', // Default active tab
      };
    },
    computed: {
      activeTabComponent() {
        return this.activeTab; // Capitalize the first letter for the component name
      },
    },
    methods: {
      setActiveTab(tab) {
        this.activeTab = tab; // Set the active tab
      },
      isActiveTab(tab) {
        return this.activeTab === tab; // Check if the tab is active
      },
    },
  };
  </script>
