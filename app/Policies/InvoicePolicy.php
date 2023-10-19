<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
{
    public function finalize(Invoice $invoice): bool
    {
        return $invoice->isApprovedBy();
    }
}
