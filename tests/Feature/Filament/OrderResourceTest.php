<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use App\Filament\Resources\OrderResource\Pages\CreateOrder;
use App\Filament\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

use function Pest\Livewire\livewire;

it('displays the order list page', function () {
    livewire(ListOrders::class)
        ->assertSuccessful();
});

it('displays the order creation page', function () {
    livewire(CreateOrder::class)
        ->assertSuccessful();
});

it('displays the order editing page', function () {
    $order = Order::factory()
        ->has(OrderItem::factory()->count(2), 'items')
        ->create();

    livewire(EditOrder::class, ['record' => $order->getRouteKey()])
        ->assertSuccessful();
});

it('displays the required columns in the order table', function (string $column) {
    livewire(ListOrders::class)
        ->assertTableColumnExists($column);
})->with([
    'user.name',
    'grand_total',
    'payment_method',
    'payment_status',
    'status',
    'shipping_method',
    'created_at',
    'updated_at',
]);

it('renders the order table columns', function (string $column) {
    livewire(ListOrders::class)
        ->assertCanRenderTableColumn($column);
})->with([
    'user.name',
    'grand_total',
    'payment_method',
    'payment_status',
    'status',
    'shipping_method',
    'created_at',
    'updated_at',
]);

it('sorts order table columns', function (string $column) {
    $orders = Order::factory(5)
        ->has(OrderItem::factory()->count(2), 'items')
        ->create();

    livewire(ListOrders::class)
        ->sortTable($column)
        ->assertCanSeeTableRecords(
            $orders->sortBy(fn ($order) => toString($order->{$column})),
            inOrder: true
        )
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords(
            $orders->sortByDesc(fn ($order) => toString($order->{$column})),
            inOrder: true
        );
})->with([
    'grand_total',
    'payment_method',
    'payment_status',
    'shipping_method',
]);

it('searches by order table columns', function (string $column) {
    $orders = Order::factory(5)
        ->has(OrderItem::factory()->count(2), 'items')
        ->create();
    $orders->load('user');

    $value = $column === 'user.name'
        ? $orders->first()->user->name
        : toString($orders->first()->{$column});

    livewire(ListOrders::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords(
            $orders->filter(fn ($order) => $column === 'user.name'
                ? $order->user->name === $value
                : toString($order->{$column}) === $value
            )
        )
        ->assertCanNotSeeTableRecords(
            $orders->filter(fn ($order) => $column === 'user.name'
                ? $order->user->name !== $value
                : toString($order->{$column}) !== $value
            )
        );
})->with([
    'user.name',
    'grand_total',
    'payment_method',
    'shipping_method',
]);

it('creates a new order', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $orderData = [
        'user_id' => $user->id,
        'payment_method' => PaymentMethod::YOOKASSA->value,
        'payment_status' => PaymentStatus::PENDING->value,
        'shipping_method' => ShippingMethod::POST_OFFICE->value,
        'status' => OrderStatus::NEW->value,
        'items' => [
            'item-1' => [
                'product_id' => $product->id,
                'quantity' => 2,
                'unit_amount' => $product->price,
                'total_amount' => $product->price * 2,
            ],
        ],
        'grand_total' => $product->price * 2,
    ];

    livewire(CreateOrder::class)
        ->set('data.items')
        ->fillForm($orderData)
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id,
        'payment_method' => PaymentMethod::YOOKASSA->value,
        'payment_status' => PaymentStatus::PENDING->value,
        'shipping_method' => ShippingMethod::POST_OFFICE->value,
        'status' => OrderStatus::NEW->value,
        'grand_total' => $product->price * 2,
    ]);
});

it('validates required fields when creating an order', function () {
    livewire(CreateOrder::class)
        ->fillForm([
            'user_id' => null,
            'payment_method' => null,
            'payment_status' => null,
            'shipping_method' => null,
            'status' => null,
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([
            'user_id' => ['required'],
            'payment_method' => ['required'],
            'payment_status' => ['required'],
            'shipping_method' => ['required'],
            'status' => ['required'],
        ]);
});

it('updates an existing order', function () {
    $order = Order::factory()
        ->has(OrderItem::factory()->count(2), 'items')
        ->create([
            'payment_status' => PaymentStatus::PENDING->value,
        ]);

    $newData = [
        'payment_status' => PaymentStatus::PAID->value,
    ];

    livewire(EditOrder::class, ['record' => $order->getRouteKey()])
        ->fillForm($newData)
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'payment_status' => PaymentStatus::PAID->value,
    ]);
});

it('deletes an order', function () {
    $order = Order::factory()
        ->has(OrderItem::factory()->count(2), 'items')
        ->create();

    livewire(EditOrder::class, ['record' => $order->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($order);
});

it('bulk deletes orders', function () {
    $orders = Order::factory(3)
        ->has(OrderItem::factory()->count(2), 'items')
        ->create();

    livewire(ListOrders::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $orders);

    foreach ($orders as $order) {
        $this->assertModelMissing($order);
    }
});

function toString(mixed $value): string
{
    return $value instanceof \BackedEnum ? $value->value : (string) $value;
}
