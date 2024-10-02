<template>
    <div v-if="isVisible" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow-lg w-96">
        <div class="p-4 border-b">
          <h2 class="text-lg font-semibold">{{ title }}</h2>
          <button @click="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-900">
            &times;
          </button>
        </div>
        <div class="p-4">
          <slot></slot>
        </div>
        <div class="p-4 border-t">
          <button @click="close" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Close</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'Modal',
    props: {
      title: {
        type: String,
        required: true,
      },
      isVisible: {
        type: Boolean,
        default: false,
      },
    },
    methods: {
      close() {
        this.$emit('update:isVisible', false);
      },
    },
  };
  </script>

  <style scoped>
  /* Add any additional styles here */
  </style>
