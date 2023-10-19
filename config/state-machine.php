<?php

use App\Enums\InvoiceStatus;
use App\Events\InvoiceFinalized;
use App\Events\InvoicePaid;
use App\Events\InvoiceVoided;
use App\Events\UnCollectableInvoicePaid;
use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\StateMachine\Repositories\StateHistoryRepository;
use App\StateMachine\Service\TransitionEventService;

return [
    'invoice-states' => [
        'class' => Invoice::class,
        'graph' => 'default',
        'property_path' => 'status',
        'states' => [
            InvoiceStatus::Draft,
            InvoiceStatus::Open,
            InvoiceStatus::Paid,
            InvoiceStatus::Void,
            InvoiceStatus::UnCollectable,
        ],
        'transitions' => [
            'finalize' => [
                'from' => [InvoiceStatus::Draft],
                'to' => InvoiceStatus::Open,
                'events' => InvoiceFinalized::class,
            ],
            'pay' => [
                'from' =>  [
                    InvoiceStatus::Open,
                    InvoiceStatus::UnCollectable,
                ],
                'to' => InvoiceStatus::Paid,
                'events' => InvoicePaid::class,
            ],
            'void' => [
                'from' => [
                    InvoiceStatus::Open,
                    InvoiceStatus::UnCollectable,
                ],
                'to' => InvoiceStatus::Void,
                'events' => InvoiceVoided::class,
            ],
            'cancel' => [
                'from' => [InvoiceStatus::Open],
                'to' => InvoiceStatus::UnCollectable,
                'events' => UnCollectableInvoicePaid::class,
            ],
        ],
        'callbacks' => [
            'guard' => [
//                'transition_finalize' => [
//                    'on' => 'finalize',
//                    'do' => [InvoicePolicy::class, 'finalize'],
//                    'args' => ['object', 'event'],
//                ],
            ],
            'before' => [],
            'after' => [
                'fire_event' => [
                    'do' => [TransitionEventService::class, 'fire'],
                    'args' => ['object', 'event'],
                ],
                'store_history' => [
                    'do' => [StateHistoryRepository::class, 'create'],
                ],
            ],
        ],
    ],
];
