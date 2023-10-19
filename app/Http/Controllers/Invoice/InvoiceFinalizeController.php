<?php

namespace App\Http\Controllers\Invoice;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceFinalizeController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice)
    {
        if (!$invoice->isDraft()) {
            return abort(403, 'Only draft invoices can be finalized.');
        }

        $invoice->update([
            'state' => InvoiceStatus::Open,
        ]);

        // Dispatch event to handle side effects.

//        $invoice->apply('finalize')->save();

        return redirect()->route('invoices.show', $invoice);
    }
}
