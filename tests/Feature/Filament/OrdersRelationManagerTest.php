<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Models\Order;
use App\Models\User;

use function Pest\Livewire\livewire;

it('displays user orders using enum', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'grand_total' => 1500,
        'status' => OrderStatus::PROCESSING->value,
        'payment_method' => PaymentMethod::YOOKASSA->value,
        'payment_status' => PaymentStatus::PAID->value,
    ]);

    $formattedTotal = '1'."\xc2\xa0".'500,00'."\xc2\xa0".'₽';

    livewire(OrdersRelationManager::class, [
        'ownerRecord' => $user,
        'pageClass' => EditUser::class,
    ])
        ->assertSee((string) $order->id)
        ->assertSee($formattedTotal)
        ->assertSee(OrderStatus::PROCESSING->getLabel())
        ->assertSee(PaymentMethod::YOOKASSA->getLabel())
        ->assertSee(PaymentStatus::PAID->getLabel());
});

it('deletes an existing order', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => OrderStatus::PROCESSING->value,
        'payment_method' => PaymentMethod::YOOKASSA->value,
        'payment_status' => PaymentStatus::PAID->value,
    ]);

    livewire(OrdersRelationManager::class, [
        'ownerRecord' => $user,
        'pageClass' => EditUser::class,
    ])
        ->callTableAction('delete', $order->id);

    $this->assertDatabaseMissing('orders', [
        'id' => $order->id,
    ]);
});

it('shows button to view order with correct URL', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => OrderStatus::PROCESSING->value,
        'payment_method' => PaymentMethod::YOOKASSA->value,
        'payment_status' => PaymentStatus::PAID->value,
    ]);

    $component = livewire(OrdersRelationManager::class, [
        'ownerRecord' => $user,
        'pageClass' => EditUser::class,
    ]);

    $component->assertSee('Посмотреть заказ');

    $expectedUrl = OrderResource::getUrl('view', ['record' => $order->id]);

    $component->assertSee($expectedUrl);
});
