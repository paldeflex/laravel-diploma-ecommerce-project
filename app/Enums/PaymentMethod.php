<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case YOOKASSA = 'yookassa';
    case COD = 'cod';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::YOOKASSA => 'ЮKassa',
            self::COD => 'Наложенный платеж',
        };
    }
}
