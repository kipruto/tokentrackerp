<template>
    <div class="h-screen flex flex-row flex-wrap">
      <Navbar />
      <Sidebar />

      <!-- Start content -->
      <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <div class="grid grid-cols-2 gap-2">
          <div class="md:py-8 py-5 md:px-16 px-5 dark:bg-gray-700 bg-white rounded shadow">
            <div class="flex justify-between items-center p-4 mb-6 bg-blue-50">
              <h1 class="text-2xl font-bold">Upcoming Events</h1>
              <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" @click="openModal">
                + Create New Event
              </button>
            </div>
            <div class="px-4">
              <div v-for="event in events" :key="event.id" class="border-b pb-4 border-gray-400 border-dashed">
                <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">{{ formatTime(event.time) }}</p>
                <a tabindex="0" class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">{{ event.title }}</a>
                <p class="text-sm pt-2 leading-4 leading-none text-gray-600 dark:text-gray-300">{{ event.description }}</p>
              </div>
            </div>
          </div>

          <div class="calendar w-full bg-white rounded shadow md:py-8 py-5 md:px-16 px-5">
            <!-- Calendar Header -->
            <div class="flex justify-between items-center mb-4">
              <span class="text-xl font-semibold" id="month-picker">{{ currentMonth }}</span>
              <div class="flex items-center">
                <span @click="changeYear(-1)" class="cursor-pointer text-lg mx-2">&lt;</span>
                <span class="text-lg font-bold">{{ currentYear }}</span>
                <span @click="changeYear(1)" class="cursor-pointer text-lg mx-2">&gt;</span>
              </div>
            </div>

            <!-- Calendar Body -->
            <div>
              <div class="grid grid-cols-7 text-center font-bold mb-2">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
              </div>
              <div class="grid grid-cols-7 gap-1 calendar-days">
                <div v-for="day in calendarDays" :key="day.key" :class="day.class">{{ day.value }}</div>
              </div>
            </div>
            <div class="month-list mt-4" v-show="showMonthList">
              <div v-for="(month, index) in monthNames" :key="index" @click="selectMonth(index)">
                {{ month }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End content -->

      <Modal v-if="showModal" @close="closeModal" />
    </div>
  </template>

  <script>
  import Navbar from '../layouts/Navbar.vue';
  import Sidebar from '../layouts/Sidebar.vue';
  import Modal from '../components/Modal.vue'; // Adjust path as needed
 
  export default {
    components: {
      Navbar,
      Sidebar,
      Modal,
    },
    data() {
      return {
        events: [], // Replace with actual events data
        showModal: false,
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        currentMonth: new Date().toLocaleString('default', { month: 'long' }),
        currentYear: new Date().getFullYear(),
        calendarDays: [],
        showMonthList: false,
      };
    },
    methods: {
      openModal() {
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      },
      selectMonth(index) {
        this.currentMonth = this.monthNames[index];
        this.showMonthList = false;
        this.generateCalendar(index, this.currentYear);
      },
      changeYear(direction) {
        this.currentYear += direction;
        this.generateCalendar(this.monthNames.indexOf(this.currentMonth), this.currentYear);
      },
      formatTime(date) {
        return new Date(date).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      },
      generateCalendar(month, year) {
        const daysInMonth = [31, this.getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        const firstDay = new Date(year, month, 1).getDay();
        const days = [];

        for (let i = 0; i < firstDay; i++) {
          days.push({ value: '', key: i, class: '' });
        }

        for (let day = 1; day <= daysInMonth[month]; day++) {
          days.push({ value: day, key: firstDay + day - 1, class: 'calendar-day-hover' });
        }

        this.calendarDays = days;
      },
      getFebDays(year) {
        return ((year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0)) ? 29 : 28;
      },
    },
    mounted() {
      this.generateCalendar(new Date().getMonth(), this.currentYear);
    },
  };
  </script>

  <style scoped>
  /* Add your component styles here */
  </style>
