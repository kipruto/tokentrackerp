<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('user_id', auth()->id())->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices');
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'invoice_number' => 'INV-' . time(),
            'invoice_date' => now(),
            'total_amount' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $request->items)),
        ]);

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return redirect()->route('invoices');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function generatePDF(Invoice $invoice)
    {
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
