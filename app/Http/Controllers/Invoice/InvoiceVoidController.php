<?php

namespace App\Http\Controllers\Invoice;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceVoidController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice)
    {
        if($invoice->isVoid()) {
            return abort(403, 'Invoice is already void.');
        } else if (!$invoice->isOpen()) {
            return abort(403, 'Only open invoices can be voided.');
        }

        $invoice->update([
            'state' => InvoiceStatus::Void,
        ]);

        // Dispatch event to handle side effects.

//        $invoice->apply('void')->save();

        return redirect()->route('invoices.show', $invoice);
    }
}
