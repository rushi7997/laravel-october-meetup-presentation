<?php

namespace App\StateMachine\Repositories;

use Illuminate\Support\Facades\Auth;
use SM\Event\TransitionEvent;

class StateHistoryRepository
{
    public static function create(TransitionEvent $event)
    {
        $sm = $event->getStateMachine();

        if (($model = $sm->getObject())?->getKey()) {
            $model->stateHistory()->create([
                'actor_id' => Auth::id(),
                'transition' => $event->getTransition(),
                'from' => $event->getState(),
                'to' => $sm->getState(),
            ]);
        }
    }
}
