<?php

namespace App\Providers;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('ru');

        DateTimePicker::$defaultDateDisplayFormat = 'd.m.Y';
        DateTimePicker::$defaultDateTimeDisplayFormat = 'd.m.Y H:i';

        Table::$defaultDateDisplayFormat = 'd.m.Y';
        Table::$defaultDateTimeDisplayFormat = 'd.m.Y H:i';

        Infolist::$defaultDateDisplayFormat = 'd.m.Y';
        Infolist::$defaultDateTimeDisplayFormat = 'd.m.Y H:i';
    }
}
