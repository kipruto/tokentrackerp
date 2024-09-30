@include('dashboard.components.navbar')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    @include('dashboard.components.sidebar')
    <!-- strat content -->
    <div class="bg-gray-100 flex-1 px-6 py-3 md:mt-16">

    <div class="bg-white shadow-sm rounded py-3 px-6 flex justify-between items-center">
        <h1 class="text-xl font-bold">Invoice Preview</h1>
        <div class="flex items-center space-x-4">
        <button class="flex items-center text-gray-600 hover:text-gray-800 transition">
            <i class="fad fa-share text-xs mr-2"></i>
                Share
            </button>
            <button class="flex items-center text-gray-600 hover:text-gray-800 transition">
            <i class="fad fa-print text-xs mr-2"></i>
                Print
            </button>
            <button class="flex items-center bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition">
            <i class="fad fa-arrow-alt-to-bottom mr-2 text-white"></i>
                Download Invoice
            </button>
        </div>
    </div>

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="max-w-3xl mx-auto py-16 px-12 bg-white rounded shadow-md my-6" id="invoice">
                <div class="grid grid-cols-2 items-center">
                    <div>
                    <h2 class="text-gray-900 text-lg font-bold">
                    Invoice #0472
                        </h2>
                    </div>
                    <div class="flex flex-col justify-items-end text-right">

                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="company-logo" height="auto" width="100">
                        <p>
                            Tailwind Inc.
                        </p>
                        <p class="text-gray-500 text-sm">
                            sales@tailwindcss.com
                        </p>
                        <p class="text-gray-500 text-sm mt-1">
                            +41-442341232
                        </p>
                        <p class="text-gray-500 text-sm mt-1">
                            VAT: 8657671212
                        </p>
                    </div>
                </div>
                <!-- Client info -->
                <div class="grid grid-cols-2 items-center mt-8">
                    <div>
                        <p class="font-bold text-gray-800">
                            Bill to :
                        </p>
                        <p class="text-gray-500">
                            Laravel LLC.
                            <br />
                            102, San-Fransico, CA, USA
                        </p>
                        <p class="text-gray-500">
                            info@laravel.com
                        </p>
                    </div>
                    <div class="text-right">

                        <p>
                            Invoice date: <span class="text-gray-500">03/07/2023</span>
                            <br />
                            Due date:<span class="text-gray-500">31/07/2023</span>
                        </p>
                    </div>
                </div>
                <!-- Invoice Items -->
                <div class="-mx-4 mt-8 flow-root sm:mx-0">
                    <table class="min-w-full">
                        <colgroup>
                            <col class="w-full sm:w-1/2">
                            <col class="sm:w-1/6">
                            <col class="sm:w-1/6">
                            <col class="sm:w-1/6">
                        </colgroup>
                        <thead class="border-b border-gray-300 text-gray-900">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-0">Items</th>
                                <th scope="col" class="px-3 py-3.5 text-right text-md font-semibold text-gray-900 sm:table-cell">Quantity</th>
                                <th scope="col" class="px-3 py-3.5 text-right text-md font-semibold text-gray-900 sm:table-cell">Price</th>
                                <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-md font-semibold text-gray-900 sm:pr-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900">E-commerce Platform</div>
                                    <div class="mt-1 truncate text-gray-500">Laravel based e-commerce platform.</div>
                                </td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">500.0</td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">$100.00</td>
                                <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$5,000.00</td>
                            </tr>

                            <tr class="border-b border-gray-200">
                                <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900">Frontend Design</div>
                                    <div class="mt-1 truncate text-gray-500">Frontend design using Vue.js and Tailwind CSS.</div>
                                </td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">500.0</td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">$100.00</td>
                                <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$5,000.00</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900">Shop SEO</div>
                                    <div class="mt-1 truncate text-gray-500">Website SEO and Social Media marketing.</div>
                                </td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">50.0</td>
                                <td class=" px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">$100.00</td>
                                <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$500.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row" colspan="3" class=" pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Subtotal</th>
                                <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">$10,500.00</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class=" pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Tax</th>
                                <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">$1,050.00</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class=" pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Discount</th>
                                <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">- 10%</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="pl-4 pr-3 pt-4 text-right text-md font-semibold text-gray-900 sm:table-cell sm:pl-0">Total</th>
                                <td class="pl-3 pr-4 pt-4 text-right text-md font-semibold text-gray-900 sm:pr-0">$11,550.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--  Footer  -->
                <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
                    Please pay the invoice before the due date. You can pay the invoice by logging in to your account from our client portal.
                </div>
            </div>

        </form>

    </div>
    <!-- end content -->
</div>
<!-- end wrapper -->

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('invoice-items');
        const itemCount = container.getElementsByClassName('item').length;

        const newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML = `
                <input type="text" name="items[${itemCount}][description]" placeholder="Item Description">
                <input type="number" name="items[${itemCount}][quantity]" placeholder="Quantity">
                <input type="number" step="0.01" name="items[${itemCount}][price]" placeholder="Price">
            `;
        container.appendChild(newItem);
    });
</script>


@include('dashboard.components.footer')