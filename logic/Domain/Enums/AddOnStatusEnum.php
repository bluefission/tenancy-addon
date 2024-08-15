<?php

namespace AddOns\Tenancy\Domain\Enums;

enum AddOnStatusEnum: string {
    case INSTALLED = 'installed';
    case PENDING = 'pending';
    case FAILED = 'failed';

    public function label(): string {
        return match ($this) {
            self::INSTALLED => 'Installed',
            self::PENDING => 'Pending',
            self::FAILED => 'Failed',
        };
    }
}
