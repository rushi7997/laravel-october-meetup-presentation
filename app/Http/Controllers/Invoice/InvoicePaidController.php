<?php

namespace App\Http\Controllers\Invoice;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicePaidController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice)
    {
        if($invoice->isPaid()) {
            return abort(403, 'Invoice is already paid.');
        } elseif (!$invoice->isOpen()) {
            return abort(403, 'Only open invoices can be paid.');
        }

        $invoice->update([
            'state' => InvoiceStatus::Paid,
        ]);

        // Dispatch event to handle side effects.

//        $invoice->apply('pay')->save();

        return redirect()->route('invoices.show', $invoice);
    }
}
