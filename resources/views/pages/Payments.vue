<template>
    <div>
      <Navbar />

      <!-- start wrapper -->
      <div class="h-screen flex flex-row flex-wrap">
        <Sidebar />
        <div class="bg-gray-100 flex-1 p-6 md:mt-16">
            <div class="mb-4">
              <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                  <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                      <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                      Home
                    </a>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                      <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Payments</a>
                    </div>
                  </li>
                </ol>
            </nav>
            </div>
        <!-- start content -->
        <div class="p-8">
            <div class="grid sm:grid-cols-1 grid-cols-2 gap-8">
              <div class="flex items-center justify-between bg-white px-8  py-12 shadow rounded-lg card">
                <div class="flex items-center space-x-4">
                  <img src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="User Profile" class="w-40 h-40 rounded-full">
                  <div class="space-y-4">
                    <h2 class="text-3xl font-bold">Wayne Jones</h2>
                    <span class="flex flex-col ">
                        <h2 class="text-sm text-gray-500">Payments Address</h2> <div class="flex items-center space-x-3 text-gray-600 bg-gray-200 px-5 py-1 rounded-md border-2 border-blue-200">
                            <p class="text-xs">1Lbcfr7sAHTD9CgdQo3HTMTk</p>
                            <button @click="copyToClipboard" class="text-blue-500 hover:text-blue-700">
                                <i class="fad fa-clone"></i>
                            </button>
                          </div>
                    </span>

                    <button class="text-sm bg-blue-500 text-white px-8 py-2 rounded hover:bg-blue-700">    <i class="fad fa-edit"></i> Edit Profile</button>
                  </div>
                </div>
              </div>

              <!-- Payments Balance Section -->
              <div class="flex items-center justify-between bg-white px-8  py-12 shadow rounded-lg card">
                    <div>
                        <i class="fad fa-payments text-4xl text-blue-500 mb-4"></i>
                        <p class="text-lg font-semibold text-gray-700">Payments Balance</p>
                        <h2 class="text-4xl font-bold">500 Tokens</h2>
                        <p class="text-gray-500 mt-1"> $500.00 USD ( 1token = $1USD ) </p>
                      </div>
                  </div>
            </div>

            <!-- Second Row - Quick Action Cards -->
            <div class="grid grid-cols-4 gap-6 sm:grid-cols-2 mt-5">
                <div class="flex items-center p-8 bg-white shadow rounded-lg card">
                  <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                    <i class="fad fa-arrow-to-bottom text-xl"></i>
                  </div>
                  <div>
                    <span class="block text-2xl font-bold">Withdraw Tokens</span>
                    <span class="block text-gray-500">Withdraw to Bank/Mpesa</span>
                  </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg card">
                  <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-orange-600 bg-orange-100  rounded-full mr-6">
                    <i class="fad fa-exchange text-xl"></i>
                  </div>
                  <div>
                    <span class="block text-2xl font-bold">Transfer Tokens</span>
                    <span class="block text-gray-500">Send to Friends/Family</span>
                  </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg card">
                  <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <i class="fad fa-hand-holding-usd text-xl"></i>
                  </div>
                  <div>
                    <span class="inline-block text-2xl font-bold">Make Payment</span>
                    <span class="block text-gray-500">Use tokens to buy online</span>
                  </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg card">
                  <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                    <i class="fad fa-list text-xl"></i>
                  </div>
                  <div>
                    <span class="block text-2xl font-bold">My Statements</span>
                    <span class="block text-gray-500">See your transactions</span>
                  </div>
                </div>
            </div>

            <!-- Third Row - Recent Transactions -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md card">
              <h2 class="text-xl font-bold mb-4">Recent Transactions</h2>
              <table class="min-w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-100">
                  <tr>
                    <th class="py-3 px-6 font-semibold text-gray-700">Date</th>
                    <th class="py-3 px-6 font-semibold text-gray-700">Description</th>
                    <th class="py-3 px-6 font-semibold text-gray-700">Amount</th>
                    <th class="py-3 px-6 font-semibold text-gray-700">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-t">
                    <td class="py-3 px-6">2024-10-01</td>
                    <td class="py-3 px-6">Token Deposit</td>
                    <td class="py-3 px-6">+100 Tokens</td>
                    <td class="py-3 px-6 "><p class="text-white bg-green-600 py-1 px-2 rounded-md w-1/3 text-center">Completed</p></td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-6">2024-09-29</td>
                    <td class="py-3 px-6">Token Withdrawal</td>
                    <td class="py-3 px-6">-50 Tokens</td>
                    <td class="py-3 px-6 "><p class="text-white bg-green-600 py-1 px-2 rounded-md w-1/3 text-center">Completed</p></td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-6">2024-09-25</td>
                    <td class="py-3 px-6">Token Transfer</td>
                    <td class="py-3 px-6">-30 Tokens</td>
                    <td class="py-3 px-6 "><p class="text-white bg-green-600 py-1 px-2 rounded-md w-1/3 text-center">Completed</p></td>
                  </tr>
                </tbody>
              </table>
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

import Navbar from '../components/partials/Navbar.vue'
import Sidebar from '../components/partials/Sidebar.vue'
import Footer from '../components/partials/Footer.vue'

export default {
    name: "Payments",
    components: {
    Navbar,
    Sidebar,
    Footer,

  },

        methods: {
          copyToClipboard() {
            navigator.clipboard.writeText("0xABC123DEF456...");
            alert('Payments address copied to clipboard!');
          }
        }
      };
      </script>
