<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasIcon, HasLabel
{
    case NEW = 'new';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NEW => 'Новый',
            self::PROCESSING => 'Обработка',
            self::SHIPPED => 'Отправлено',
            self::DELIVERED => 'Доставлено',
            self::CANCELED => 'Отменено',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NEW => 'info',
            self::PROCESSING => 'warning',
            self::SHIPPED => 'success',
            self::DELIVERED => 'delivered',
            self::CANCELED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NEW => 'heroicon-m-sparkles',
            self::PROCESSING => 'heroicon-m-arrow-path',
            self::SHIPPED => 'heroicon-m-truck',
            self::DELIVERED => 'heroicon-m-check-badge',
            self::CANCELED => 'heroicon-m-x-circle',
        };
    }
}
