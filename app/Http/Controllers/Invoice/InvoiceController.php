<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('index', [
            'invoices' => Invoice::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Invoice::create();

        return redirect()->route('invoices.index');
    }

    public function show(Invoice $invoice)
    {
        return view('show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index');
    }
}
