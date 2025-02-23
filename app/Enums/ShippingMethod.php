<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ShippingMethod: string implements HasLabel
{
    case POST_OFFICE = 'post_office';
    case SDEK = 'sdek';
    case BOXBERRY = 'boxberry';
    case YANDEX_MARKET = 'yandex_market';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::POST_OFFICE => 'Почта России',
            self::SDEK => 'СДЭК',
            self::BOXBERRY => 'Boxberry',
            self::YANDEX_MARKET => 'Яндекс.Маркет',
        };
    }
}
