<?php

namespace App\Events;

use App\Models\Invoice;
use App\StateMachine\Events\StateTransitionEvent;
use Sebdesign\SM\Event\TransitionEvent;

class InvoiceFinalized extends StateTransitionEvent
{
    public function __construct(protected Invoice $invoice, TransitionEvent $event = null)
    {
        parent::__construct($event);
    }
}
