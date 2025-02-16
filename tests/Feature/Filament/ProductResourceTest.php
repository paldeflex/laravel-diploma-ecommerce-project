<?php

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Models\Category;
use App\Models\CoatingType;
use App\Models\Product;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Pest\Livewire\livewire;

beforeEach(function () {
    DB::table('products')->truncate();
});

it('can display the product list page', function () {
    livewire(ListProducts::class)
        ->assertSuccessful();
});

it('can display the product creation page', function () {
    livewire(CreateProduct::class)
        ->assertSuccessful();
});

it('can display the product editing page', function () {
    $record = Product::factory()->create();

    livewire(EditProduct::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

it('displays the required columns in the table', function (string $column) {
    livewire(ListProducts::class)
        ->assertTableColumnExists($column);
})->with([
    'name',
    'slug',
    'category.name',
    'coatingTypes.name',
    'price',
    'is_featured',
    'in_stock',
    'on_sale',
    'is_active',
    'created_at',
    'updated_at',
]);

it('can render table columns', function (string $column) {
    livewire(ListProducts::class)
        ->assertCanRenderTableColumn($column);
})->with([
    'name',
    'slug',
    'category.name',
    'coatingTypes.name',
    'price',
    'is_featured',
    'in_stock',
    'on_sale',
    'is_active',
    'created_at',
    'updated_at',
]);

it('can sort table records by columns', function (string $column) {
    $records = Product::factory(5)->create();

    livewire(ListProducts::class)
        ->sortTable($column)
        ->assertCanSeeTableRecords($records->sortBy($column), inOrder: true)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder: true);
})->with(['name', 'price', 'created_at', 'updated_at']);

it('can search by table columns', function (string $column) {
    $records = Product::factory(5)->create();

    $value = $records->first()->{$column} ?? null;
    if (! is_string($value)) {
        $this->markTestSkipped("Column '{$column}' value is not suitable for searching.");
    }

    livewire(ListProducts::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['name', 'slug']);

it('can create a new product', function () {
    $category     = Category::factory()->create();
    $coatingType1 = CoatingType::factory()->create();
    $coatingType2 = CoatingType::factory()->create();

    $record = Product::factory()->make();

    livewire(CreateProduct::class)
        ->fillForm([
            'name'          => $record->name,
            'price'         => $record->price,
            'in_stock'      => $record->in_stock,
            'is_featured'   => $record->is_featured,
            'is_active'     => $record->is_active,
            'on_sale'       => $record->on_sale,
            'category_id'   => $category->id,
            'coatingTypes'  => [$coatingType1->id, $coatingType2->id],
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('products', [
        'name'  => $record->name,
        'price' => $record->price,
    ]);
});

it('can update an existing product', function () {
    $coatingType1 = CoatingType::factory()->create();
    $coatingType2 = CoatingType::factory()->create();

    $record = Product::factory()
        ->hasAttached([$coatingType1, $coatingType2])
        ->create();

    $newRecord = Product::factory()->make();

    livewire(EditProduct::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'coatingTypes' => [$coatingType1->id, $coatingType2->id],
            'category_id'  => $record->category_id,
            'name'         => $newRecord->name,
            'price'        => $newRecord->price,
            'in_stock'     => $newRecord->in_stock,
            'is_featured'  => $newRecord->is_featured,
            'is_active'    => $newRecord->is_active,
            'on_sale'      => $newRecord->on_sale,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('products', [
        'id'    => $record->id,
        'name'  => $newRecord->name,
        'price' => $newRecord->price,
    ]);
});

it('can delete a product', function () {
    $record = Product::factory()->create();

    livewire(EditProduct::class, ['record' => $record->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($record);
});

it('can bulk delete products', function () {
    $records = Product::factory(5)->create();

    livewire(ListProducts::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $records);

    foreach ($records as $record) {
        $this->assertModelMissing($record);
    }
});

it('validates that name field is required', function () {
    livewire(CreateProduct::class)
        ->fillForm([
            'name' => null,
            'price' => 1000,
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => ['required']]);
});

it('validates that name field cannot exceed 255 characters', function () {
    livewire(CreateProduct::class)
        ->fillForm([
            'name' => Str::random(256),
            'price' => 1000,
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => ['max:255']]);
});

it('validates that price field is required and must be a number', function () {
    livewire(CreateProduct::class)
        ->fillForm([
            'name' => 'Test Product',
            'price' => null,
        ])
        ->call('create')
        ->assertHasFormErrors(['price' => ['required']]);

    livewire(CreateProduct::class)
        ->fillForm([
            'name' => 'Test Product',
            'price' => 'not-a-number',
        ])
        ->call('create')
        ->assertHasFormErrors(['price' => ['numeric']]);
});
