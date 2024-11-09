<template>
    <!-- start sidebar -->
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
        <!-- sidebar content -->
        <div class="flex flex-col sidebarlist space-y-3">
            <!-- sidebar toggle -->
            <div class="text-right hidden md:block mb-4">
                <button id="sideBarHideBtn">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
            <!-- end sidebar toggle -->

            <!-- Dashboard -->
            <a href="/dashboard" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500">
                <div class="flex items-center">
                    <i class="fas fa-house text-md"></i>
                    <span class="ml-2">Dashboard</span>
                </div>
            </a>

            <!-- Work Section -->
            <a @click="toggleDropdown('work')" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 cursor-pointer border-t">
                <div class="flex items-center">
                    <i class="fas fa-briefcase text-md"></i>
                    <span class="ml-2">Workspace</span>
                </div>
                <i :class="`fas transition-transform ${dropdowns.work ? 'text-xs fa-chevron-up' : 'text-xs fa-chevron-down'}`"></i>
            </a>
            <div v-if="dropdowns.work" class="ml-6 py-5 space-y-2 bg-gray-100 rounded-md sidespacer">
                <a href="/projects" class="ml-4 block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Projects</a>
                <a href="/timesheets" class="ml-4 block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Timesheets</a>
                <a href="/clients" class="ml-4 block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Clients</a>
            </div>


                 <a href="/messages" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 border-t">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-md"></i>
                        <span class="ml-2">Messages</span>
                    </div>
                </a>

            <!-- Additional Sections -->
            <a href="/payments" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 border-t">
                <div class="flex items-center">
                    <i class="fas fa-wallet text-md"></i>
                    <span class="ml-2">Payments</span>
                </div>
            </a>

            <a href="/calendar" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 border-t">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-md"></i>
                    <span class="ml-2">Events</span>
                </div>
            </a>

            <a href="/notes" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 border-t">
                <div class="flex items-center">
                    <i class="fas fa-sticky-note text-md"></i>
                    <span class="ml-2">Sticky Notes</span>
                </div>
            </a>

              <!-- HR Section -->
              <a @click="toggleDropdown('hr')" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 cursor-pointer border-t">
                <div class="flex items-center">
                    <i class="fas fa-user-tie text-md"></i>
                    <span class="ml-2">Employee Center</span>
                </div>
                <i :class="`fas transition-transform ${dropdowns.hr ? 'text-xs fa-chevron-up' : 'text-xs fa-chevron-down'}`"></i>
            </a>
            <div v-if="dropdowns.hr" class="ml-6 py-5 space-y-2 bg-gray-100 rounded-md sidespacer">
                <a href="/leave-application" class="ml-4 block text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Leave Application</a>
                <a href="/attendance-sheet" class="ml-4 block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Attendance Records</a>
                <a href="/request-refund" class="ml-4 block text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Request Refund</a>
                <a href="/file-complaint" class="ml-4 block text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">File Complaint</a>
            </div>


            <!-- Recruit Section -->
            <a @click="toggleDropdown('recruit')" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 cursor-pointer border-t">
                <div class="flex items-center">
                    <i class="fas fa-user-friends text-md"></i>
                    <span class="ml-2">Teams</span>
                </div>
                <i :class="`fas transition-transform ${dropdowns.recruit ? 'text-xs fa-chevron-up' : 'text-xs fa-chevron-down'}`"></i>
            </a>
            <div v-if="dropdowns.recruit" class="ml-6 py-3 space-y-2 bg-gray-100 rounded-md sidespacer">
                <a href="/teams" class="block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Team Members</a>
                <a href="/recruit" class="block capitalize text-sm hover:text-teal-600 transition ease-in-out duration-500 hover:underline">Job Board</a>
            </div>

            <!-- Settings -->
            <a href="/settings" class="flex items-center justify-between w-full capitalize hover:text-teal-600 transition ease-in-out duration-500 border-t">
                <div class="flex items-center">
                    <i class="fas fa-cog text-md"></i>
                    <span class="ml-2">Settings</span>
                </div>
            </a>
        </div>
        <!-- end sidebar content -->
    </div>
    <!-- end sidebar -->
</template>

<script>
import axios from "axios";
import { ref } from 'vue';
import { mapState, mapGetters } from "vuex";

export default {
    name: "SideBar",
    setup() {
        const dropdowns = ref({
            hr: false,
            work: false,
            recruit: false,
            workspaces: false
        });

        const toggleDropdown = (dropdown) => {
            dropdowns.value[dropdown] = !dropdowns.value[dropdown];
        };

        const workspaces = ref([]);

        return {
            dropdowns,
            toggleDropdown,
            workspaces,
        };
    },

    computed: {
        ...mapGetters(['isSuperAdmin'])
    },

    async mounted() {
        await this.fetchWorkspaces();
    },

    methods: {
        async fetchWorkspaces() {
            try {
                const response = await axios.get("/api/workspaces");
                this.workspaces = response.data;
            } catch (error) {
                console.error("Error fetching workspaces:", error);
            }
        },
    },
};
</script>
