<?php

namespace App\StateMachine\Service;

use App\StateMachine\Events\StateTransitionEvent;
use Illuminate\Database\Eloquent\Model;
use SM\Event\TransitionEvent;

class TransitionEventService
{
    /**
     * Set event classes on transitions.{name}.event key within state-machine config
     * Events are auto-fired after state transition.
     *
     * Note: Not guaranteed to have updated model state, as the event may be processed before the state change is saved.
     * Add a delay to the listener if needed
     *
     * @param Model $model
     * @param TransitionEvent $event
     */
    public static function fire(Model $model, TransitionEvent $event)
    {
        if ($event->isRejected()) {
            return;
        }

        collect($event->getConfig()['events'] ?? null)
            ->filter('filled')
            ->each(function ($eventClass) use ($model, $event) {
                if (is_subclass_of($eventClass, StateTransitionEvent::class)) {
                    event(new $eventClass($model, $event));
                }
            });
    }
}
