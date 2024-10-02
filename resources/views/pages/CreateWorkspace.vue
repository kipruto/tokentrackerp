<template>
    <div>
      <Navbar />

      <!-- start wrapper -->
      <div class="h-screen flex flex-row flex-wrap">
        <Sidebar />

        <!-- start content -->
        <div class="bg-gray-100 flex-1 p-6 md:mt-16">


  <div class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            <i class="fad fa-folder text-xs mr-2"></i>
        Create Workspace
        </a>
      </li>
    </ol>
  </div>

    <div class="max-w-4xl mx-auto space-y-8">
      <div>
        <h2 class="mt-32 text-center text-3xl font-extrabold text-gray-900">
          Create a New Workspace
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
         A workspace is where you manage all the tasks and assignments of a particular project
        </p>
      </div>
      <form @submit.prevent="handleSubmit" class="mt-8 space-y-6">
        <div class="rounded-md shadow-sm -space-y-px">
          <div class="my-5">
            <label for="workspace-name" class="sr-only">Workspace Name</label>
            <input v-model="workspaceName" id="workspace-name" name="workspaceName" type="text" required
              class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Workspace Name">
          </div>
          <div>
            <label for="workspace-description" class="sr-only">Description</label>
            <textarea v-model="description" id="workspace-description" name="description" rows="4" required
              class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Workspace Description"></textarea>
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create Workspace
          </button>
        </div>
      </form>
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
    name: 'Dashboard',
    components: {
      Navbar,
      Sidebar,
      Footer
    },

    setup(){

    },
    computed : {

  },
    mounted() {

    },
  methods: {

  }

  }
  </script>

  <style scoped>



  </style>