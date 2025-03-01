<?php

use App\Filament\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;

use function Pest\Livewire\livewire;

it('address belongs to the same user as the order', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $address = Address::factory()->create([
        'user_id' => $user->id,
        'order_id' => $order->id,
    ]);

    expect($address->user_id)->toBe($order->user_id);
});

it('deletes an existing address', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $address = Address::factory()->create([
        'user_id' => $user->id,
        'order_id' => $order->id,
    ]);

    livewire(AddressRelationManager::class, [
        'ownerRecord' => $order,
        'pageClass' => EditOrder::class,
    ])
        ->callTableAction('delete', $address->id);

    $this->assertDatabaseMissing('addresses', [
        'id' => $address->id,
    ]);
});

it('creates a new address', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);

    $addressData = [
        'first_name' => 'Ivan',
        'last_name' => 'Ivanov',
        'phone' => '1234567890',
        'city' => 'Moscow',
        'region' => 'Moscow Region',
        'zip_code' => '123456',
        'street_address' => 'Lenina St., 1',
    ];

    livewire(AddressRelationManager::class, [
        'ownerRecord' => $order,
        'pageClass' => EditOrder::class,
    ])
        ->mountTableAction('create')
        ->setTableActionData($addressData)
        ->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertDatabaseHas('addresses', array_merge($addressData, [
        'order_id' => $order->id,
        'user_id' => $user->id,
    ]));
});

it('edits an existing address', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $address = Address::factory()->create([
        'user_id' => $user->id,
        'order_id' => $order->id,
        'first_name' => 'Ivan',
        'last_name' => 'Ivanov',
        'phone' => '1234567890',
        'city' => 'Moscow',
        'region' => 'Moscow Region',
        'zip_code' => '123456',
        'street_address' => 'Lenina St., 1',
    ]);

    livewire(AddressRelationManager::class, [
        'ownerRecord' => $order,
        'pageClass' => EditOrder::class,
    ])
        ->mountTableAction('edit', $address->id)
        ->assertFormSet([
            'first_name' => $address->first_name,
        ], 'mountedTableActionForm')
        ->setTableActionData([
            'first_name' => 'Petr',
            'last_name' => 'Petrov',
            'phone' => '0987654321',
            'city' => 'Saint Petersburg',
            'region' => 'Leningrad Region',
            'zip_code' => '654321',
            'street_address' => 'Nevsky Ave., 5',
        ])
        ->callMountedTableAction()
        ->assertHasNoTableActionErrors();

    $this->assertDatabaseHas('addresses', [
        'id' => $address->id,
        'first_name' => 'Petr',
        'last_name' => 'Petrov',
    ]);
});

it('validates required fields when creating an address', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);

    livewire(AddressRelationManager::class, [
        'ownerRecord' => $order,
        'pageClass' => EditOrder::class,
    ])
        ->mountTableAction('create')
        ->setTableActionData([])
        ->callMountedTableAction()
        ->assertHasTableActionErrors([
            'first_name',
            'last_name',
            'phone',
            'city',
            'region',
            'zip_code',
            'street_address',
        ]);
});

it('correctly displays the full name', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $address = Address::factory()->create([
        'user_id' => $user->id,
        'order_id' => $order->id,
        'first_name' => 'Ivan',
        'last_name' => 'Ivanov',
    ]);

    livewire(AddressRelationManager::class, [
        'ownerRecord' => $order,
        'pageClass' => EditOrder::class,
    ])
        ->assertSee($address->full_name);
});
