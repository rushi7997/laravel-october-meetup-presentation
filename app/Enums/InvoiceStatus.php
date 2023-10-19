<?php

namespace App\Enums;

abstract class InvoiceStatus
{
    public const Draft = 'DRAFT';
    public const Open = 'OPEN';
    public const Paid = 'PAID';
    public const Void = 'VOID';
    public const UnCollectable = 'UN-COLLECTABLE';

    public static function getBadgeColor($status): string
    {
        return match ($status) {
            self::Draft => 'secondary',
            self::Open => 'primary',
            self::Paid => 'success',
            self::Void => 'info',
            self::UnCollectable => 'danger',
        };
    }
}
