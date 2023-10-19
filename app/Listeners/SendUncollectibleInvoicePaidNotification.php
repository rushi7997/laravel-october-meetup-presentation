<?php

namespace App\Listeners;

use App\Events\UnCollectableInvoicePaid;

class SendUncollectibleInvoicePaidNotification
{
    public function handle(UnCollectableInvoicePaid $event): void
    {
        // Send notification to the user.
    }
}
