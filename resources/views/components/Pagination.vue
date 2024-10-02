<template>
    <div class="flex justify-between items-center">
      <button
        @click="prevPage"
        :disabled="currentPage === 1"
        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:bg-gray-300"
      >
        Previous
      </button>

      <div class="flex items-center">
        <span class="mx-2">Page {{ currentPage }} of {{ totalPages }}</span>
        <button
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:bg-gray-300"
        >
          Next
        </button>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'Pagination',
    props: {
      totalPages: {
        type: Number,
        required: true,
      },
      currentPage: {
        type: Number,
        default: 1,
      },
    },
    methods: {
      prevPage() {
        if (this.currentPage > 1) {
          this.$emit('update:currentPage', this.currentPage - 1);
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.$emit('update:currentPage', this.currentPage + 1);
        }
      },
    },
  };
  </script>

  <style scoped>
  /* Add any additional styles here */
  </style>
