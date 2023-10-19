<?php

namespace App\Listeners;

use App\Events\InvoiceVoided;

class SendInvoiceVoidedNotification
{
    public function handle(InvoiceVoided $event): void
    {
        // Send notification to the user.
    }
}
