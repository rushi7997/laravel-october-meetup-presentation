<?php

namespace App\StateMachine\Traits;

use App\StateMachine\Models\StateHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use SM\Factory\Factory as StateMachineFactory;
use SM\SMException;
use SM\StateMachine\StateMachineInterface;

/**
 * @mixin Model
 *
 * @property Collection $stateHistory
 */
trait Statable
{
    protected ?StateMachineInterface $stateMachine = null;

    public function stateHistory(): MorphMany
    {
        return $this->morphMany(StateHistory::class, 'statable')->oldest();
    }

    /**
     * @throws SMException
     */
    public function state(): string
    {
        return $this->stateMachine()->getState();
    }

    /**
     * @throws \SM\SMException
     */
    public function apply(string $transition, bool $soft = false, array $context = []): static
    {
        $this->stateMachine()->apply($transition, $soft, $context);

        return $this;
    }

    /**
     * @throws \SM\SMException
     */
    public function canApply(string $transition, array $context = []): bool
    {
        return $this->stateMachine()->can($transition, $context);
    }

    /**
     * @throws \SM\SMException
     */
    public function stateMachine(): StateMachineInterface
    {
        if (!$this->stateMachine) {
            /** @var StateMachineFactory $factory */
            $factory = app('sm.factory');
            $this->stateMachine = $factory->get($this, $this->getGraph());
        }

        return $this->stateMachine;
    }

    protected function getGraph(): string
    {
        return 'default';
    }
}
