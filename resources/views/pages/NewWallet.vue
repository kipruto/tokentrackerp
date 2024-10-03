<template>

    <div className='flex mb-8'>
        <div className='flex-1 text-3xl font-medium text-gray-700'>January 27 2021</div>
        <div className="mr-12 text-xl font-medium text-gray-400">
          Number of transactions: 21
        </div>
        <div className='text-xl font-medium text-gray-400'>
          Value: $200
        </div>
      </div>
      <div className='container max-w-6xl mx-auto space-y-8'>
        <div className='flex items-center p-10 bg-white rounded-lg shadow-sm'>
            <div className="p-2 font-semibold rounded-lg">
              <svg
              className='w-8 h-8'
              fill='none'
              stroke='currentColor'
              viewBox='0 0 24 24'
              xmlns='http://www.w3.org/2000/svg'>
              <path
                strokeLinecap='round'
                strokeLinejoin='round'
                strokeWidth={2}
                d='M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'
              />
            </svg>
            </div>
            <div className='flex-1 ml-4'>
              <div className='text-2xl font-semibold leading-5 text-gray-700'>Withdraw</div>
              <div className='text-xl font-medium text-gray-400'>27 January 2021</div>
            </div>
            <div className='text-2xl font-semibold text-gray-700'>
        $200
            </div>
          </div>
          <div className='mx-auto'>
            <div className='text-2xl font-semibold text-center text-gray-600'>
              No Transactions as of yet
            </div>
            <img
              className='mx-auto'
              src='https://img.icons8.com/fluent/120/000000/nothing-found.png'
              alt='not found'
            />
          </div>

      </div>


</template>

<script>

import Navbar from '../layouts/Navbar.vue'
import Sidebar from '../layouts/Sidebar.vue'

export default {
    name:"NewWallet",
    components: {
    Navbar,
    Sidebar,

  },

        methods: {
          copyToClipboard() {
            navigator.clipboard.writeText("0xABC123DEF456...");
            alert('Wallet address copied to clipboard!');
          }
        }
      };
      </script>