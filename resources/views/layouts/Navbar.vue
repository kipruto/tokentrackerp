<template>
<div class="bg-gray-100">
    <div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">
        <!-- logo -->
        <div class="flex-none w-56 flex flex-row items-center">
            <img :src="logo" class="w-10 flex-none" />
            <strong class="capitalize ml-1 flex-1">TokenTrackerERP</strong>

            <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
                <i class="fad fa-list-ul"></i>
            </button>
        </div>
        <!-- end logo -->

        <!-- navbar content toggle -->
        <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
            <i class="fad fa-chevron-double-down"></i>
        </button>
        <!-- end navbar content toggle -->

        <!-- navbar content -->
        <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
            <!-- left -->
            <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200">
                <!-- Add any left-side content here -->
            </div>
            <!-- end left -->

            <!-- right -->
            <div class="flex flex-row-reverse items-center">
                <!-- user -->
                <div class="dropdown md:static ">
                    <button @click.prevent="toggleDropdown" id="modalbutton" class=" focus:outline-none focus:shadow-outline flex flex-wrap items-center" type="button">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg">
                            {{ initials }}
                        </div>
                        <div class="ml-2 capitalize flex ">
                            <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ firstName }}</h1>
                            <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
                        </div>
                    </button>
                    <div v-if="isDropdownOpen" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0"> <i class="fas fa-user-cog text-xs mr-3"></i> Account Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1"> <i class="fas fa-question-circle mr-3"></i>Support</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 border-b" role="menuitem" tabindex="-1" id="menu-item-2"> <i class="fas fa-key text-xs mr-3"></i>Purchase License</a>
                            <form method="POST" @submit.prevent="logout">
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3"> <i class="fas fa-sign-out text-xs mr-3"></i>Sign Out</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end user -->

                <!-- notification -->
                <div class="dropdown md:static mr-6">
                    <button @click.prevent="toggleNotificationDropdown" id="modalbutton" class=" focus:outline-none focus:shadow-outline flex flex-wrap items-center" type="button">
                        <i class="far fa-bell text-xl"></i>
                    </button>
                    <div v-if="isNotificationDropdownOpen" class="absolute right-0 z-10 mt-2 w-[300px] origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none px-3" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <h1 class="text-md font-bold border-b pb-2">Notifications</h1>

                            <div v-if="notifications.length > 0" class="space-y-4 max-h-[300px] overflow-y-auto">
                                <div v-for="(notification, index) in notifications" :key="index" class="flex flex-row border-b border-gray-200 text-gray-700 p-4" role="alert">

                                    <div class="mr-4  text-white w-1/3">
                                        <img class="h-22 rounded-full" src="https://as1.ftcdn.net/v2/jpg/09/48/09/30/1000_F_948093078_6kRWXnAWFNEaakRMX5OM9CRNNj2gdIfw.jpg">
                                    </div>
                                    <div class="2/3">
                                        <p class="mr-1 text-xs"> <b class="text-md"> {{ notification.from }} </b> {{ notification.title }}, {{ notification.message }} <b>KES: {{ notification.budget_allocated}}</b></p>
                                    </div>

                                </div>
                                <div class="flex mx-auto w-full text-center items-center justify-center sticky bottom-0 bg-white py-2">
                                    <a href="" class="px-12 py-2 text-xs text-gray-700 bg-gray-300 rounded-full mb-2" role="menuitem" tabindex="-1">See all notifications</a>
                                </div>
                            </div>
                            <div v-else class="flex flex-col items-center justify-center h-[100px]  my-12 text-center">
                                <i class="fad fa-bell text-3xl mx-auto mb-1"></i>
                                <p class="text-md font-bold">No notifications yet</p>
                                <p class="text-xs text-gray-400">When you get notifications, they will show up here.</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end notification -->

            </div>
            <!-- end right -->
        </div>
        <!-- end navbar content -->
    </div>
</div>
</template>

<script>
import logo from '../../../public/images/logo.png';
import {
    mapGetters,
    mapState
} from 'vuex';
import {
    ref
} from 'vue';
import {
    useRouter
} from 'vue-router';
import store from "../../store";

export default {
    name: 'Navbar',
    setup() {
        const router = useRouter();
        const isDropdownOpen = ref(false);
        const isNotificationDropdownOpen = ref(false);

        return {
            logo,
            initials: null,
            firstName: null,
            isDropdownOpen,
            isNotificationDropdownOpen,
            router,
        };

    },

    computed: {

        ...mapState({
            notifications: state => state.workspace.notifications,
        }),

        ...mapGetters(['getUser']),
        user() {
            return this.getUser;
        },

    },
    mounted() {
        window.addEventListener('click', this.closeDropdown);
        window.addEventListener('click', this.closeNotificationDropdown);
        this.setInitials();

    },

    beforeUnmount() {
        window.removeEventListener('click', this.closeDropdown);
        window.removeEventListener('click', this.closeNotificationDropdown);
    },

    methods: {

        setInitials() {
            const user = this.user;
            if (!user) {
                return;
            }
            const nameParts = user.name.split(' ');
            const initials = nameParts.map(part => part.charAt(0)).join('').toUpperCase();
            this.initials = initials;
            this.firstName = user.name.split(' ')[0];
        },

        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },

        toggleNotificationDropdown() {

            this.isNotificationDropdownOpen = !this.isNotificationDropdownOpen;
        },

        closeDropdown(event) {
            if (!event.target.closest('.dropdown')) {
                this.isDropdownOpen = false;
            }
        },

        closeNotificationDropdown(event) {
            if (!event.target.closest('.dropdown')) {
                this.isNotificationDropdownOpen = false;
            }
        },

        async logout() {
            await store.dispatch('logout');
            const keysToRemove = ['user', 'userNotes', 'workspaceid'];
            keysToRemove.forEach(key => {
                localStorage.removeItem(key);
            });
            this.router.push({
                path: '/'
            });

        },
    },
    watch: {

        user(newUser) {
            if (newUser) {
                this.setInitials();
            }
        }
    },
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
