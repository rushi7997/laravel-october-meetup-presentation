<?php

namespace App\Listeners;

use App\Events\InvoicePaid;

class SendInvoicePaidNotification
{
    public function handle(InvoicePaid $event): void
    {
        // Send notification to the user.
    }
}
