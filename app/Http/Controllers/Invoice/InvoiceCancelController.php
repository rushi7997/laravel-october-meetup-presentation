<?php

namespace App\Http\Controllers\Invoice;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceCancelController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice)
    {
        if ($invoice->isPaid()){
            return abort(403, 'Paid invoices cannot be cancelled.');
        }
        $invoice->update([
            'state' => InvoiceStatus::UnCollectable,
        ]);

        // Dispatch event to handle side effects.

//        $invoice->apply('cancel')->save();

        return redirect()->route('invoices.show', $invoice);
    }
}
