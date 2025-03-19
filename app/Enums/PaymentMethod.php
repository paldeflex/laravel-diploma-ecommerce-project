<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case COD = 'cod';
    case YOOKASSA = 'yookassa';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::COD => 'Наложенный платеж',
            self::YOOKASSA => 'ЮKassa',
        };
    }
}
