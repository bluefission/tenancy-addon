<?php

namespace AddOns\Tenancy\Domain\Enums;

enum LogTypeEnum: string {
    case INFO = 'info';
    case WARNING = 'warning';
    case ERROR = 'error';

    public function label(): string {
        return match ($this) {
            self::INFO => 'Information',
            self::WARNING => 'Warning',
            self::ERROR => 'Error',
        };
    }
}
