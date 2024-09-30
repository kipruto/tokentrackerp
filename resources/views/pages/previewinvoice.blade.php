@include('dashboard.components.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    @include('dashboard.components.sidebar')

    <!-- strat content -->
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        <h1>Invoices</h1>
        <a href="{{ route('invoices.create') }}">Create New Invoice</a>
        <table>
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}">View</a>
                        <a href="{{ route('invoices.generatePDF', $invoice->id) }}">Download PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end content -->
</div>
<!-- end wrapper -->



@include('dashboard.components.footer')