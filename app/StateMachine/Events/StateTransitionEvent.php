<?php

namespace App\StateMachine\Events;

use Illuminate\Support\Facades\Event;
use Sebdesign\SM\Event\TransitionEvent;

class StateTransitionEvent extends Event
{
    public string $state;
    public string $fromState;
    public array $context = [];

    public function __construct(TransitionEvent $event = null)
    {
        if ($event) {
            $this->state = $event->getTransition();
            $this->fromState = $event->getState();
            $this->context = $event->getContext();
        }
    }
}
