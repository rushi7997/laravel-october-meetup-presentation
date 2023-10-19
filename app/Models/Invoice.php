<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\StateMachine\Traits\Statable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $reference_id
 * @property string $status
 */
class Invoice extends Model
{
    use HasFactory,
        Statable;

    protected $fillable = [
        'reference_id',
        'status',
    ];

    protected $attributes = [
        'status' => InvoiceStatus::Draft,
    ];

    protected static function booted()
    {
        static::creating(function (Invoice $invoice) {
            $invoice->reference_id = Str::ucfirst(Str::random(8));
        });
    }

    public function isDraft(): bool
    {
        return $this->status == InvoiceStatus::Draft;
    }

    public function isUnCollectable(): bool
    {
        return $this->status == InvoiceStatus::UnCollectable;
    }

    public function isOpen(): bool
    {
        return $this->status == InvoiceStatus::Open;
    }

    public function isPaid(): bool
    {
        return $this->status == InvoiceStatus::Paid;
    }

    public function isVoid(): bool
    {
        return $this->status == InvoiceStatus::Void;
    }

    public function isApprovedBy(User $user = null): bool
    {
        return true;
    }
}
