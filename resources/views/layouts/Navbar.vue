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
      <div
        id="navbar"
        class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center"
      >
        <!-- left -->
        <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200">
          <!-- Add any left-side content here -->
        </div>
        <!-- end left -->

        <!-- right -->
        <div class="flex flex-row-reverse items-center">
          <!-- user -->
          <div class="dropdown relative md:static">
            <button id="modalbutton" class="menu-btn focus:outline-none focus:shadow-outline flex flex-wrap items-center" type="button">
              <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg">
                {{ initials }}
              </div>

              <div class="ml-2 capitalize flex ">
                <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ firstName }}</h1>
                <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
              </div>
            </button>

            <div
              id="modalpopup"
              class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster"
            >
              <!-- item -->
              <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                <i class="fad fa-edit text-xs mr-1"></i>
                edit my profile
              </a>
              <!-- end item -->

              <!-- item -->
              <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                <i class="fad fa-tools text-xs mr-1"></i>
                settings
              </a>
              <!-- end item -->

              <!-- item -->
              <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                <i class="fad fa-user-cog text-xs mr-1"></i>
                manage users
              </a>
              <!-- end item -->

              <hr />

              <!-- item -->
              <form @submit.prevent="logout" id="logoutForm">
                <a
                  class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                  @click="logout"
                >
                  <i class="fad fa-sign-out text-xs mr-1"></i>
                  log out
                </a>
              </form>
              <!-- end item -->
            </div>
          </div>
          <!-- end user -->

          <!-- notification -->
          <div class="dropdown relative mr-5 md:static">
            <button class="text-gray-500 menu-btn p-0 m-0 hover:text-gray-900 focus:text-gray-900 focus:outline-none transition-all ease-in-out duration-300">
              <i class="fad fa-bells"></i>
            </button>

            <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

            <div class="menu hidden rounded bg-white md:right-0 md:w-full shadow-md absolute z-20 right-0 w-84 mt-5 py-2 animated faster">
              <!-- top -->
              <div class="px-4 py-2 flex flex-row justify-between items-center capitalize font-semibold text-sm">
                <h1>notifications</h1>
                <div class="bg-teal-100 border border-teal-200 text-teal-500 text-xs rounded px-1">
                  <strong>5</strong>
                </div>
              </div>
              <hr />
              <!-- end top -->

              <!-- body -->
              <!-- <notification-item title="poll.." time="4 min ago" icon="fad fa-birthday-cake" />
              <notification-item title="mohamed.." time="78 min ago" icon="fad fa-user-circle" />
              <notification-item title="new imag.." time="65 min ago" icon="fad fa-images" />
              <notification-item title="time is up.." time="1 min ago" icon="fad fa-alarm-exclamation" /> -->
              <!-- end body -->

              <!-- bottom -->
              <hr />
              <div class="px-4 py-2 mt-2">
                <a href="#" class="border border-gray-300 block text-center text-xs uppercase rounded p-1 hover:text-teal-500 transition-all ease-in-out duration-500">
                  view all
                </a>
              </div>
              <!-- end bottom -->
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
import { mapGetters } from 'vuex';

export default {
  name: 'Navbar',
  data() {
    return {
      logo,
      initials: null,
      firstName: null,
    };
  },
  computed: {

    ...mapGetters(['getUser']),
    user(){
      return this.getUser;
    },

  },
  mounted() {
    this.setInitials();

  },
  methods: {
    setInitials() {
      const user = this.user;
      if (!user) {
        return;
      }
      const nameParts  = user.name.split(' ');
      const initials = nameParts.map(part => part.charAt(0)).join('').toUpperCase();
      this.initials = initials;
      this.firstName = user.name.split(' ')[0];
    },

    logout() {
      console.log('Logging out...');
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
