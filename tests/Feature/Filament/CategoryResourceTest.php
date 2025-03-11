<?php

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

it('can display the category list page', function () {
    livewire(ListCategories::class)
        ->assertSuccessful();
});

it('can display the category creation page', function () {
    livewire(CreateCategory::class)
        ->assertSuccessful();
});

it('can display the category editing page', function () {
    $record = Category::factory()->create();

    livewire(EditCategory::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

it('displays the required columns in the table', function (string $column) {
    livewire(ListCategories::class)
        ->assertTableColumnExists($column);
})->with(['name', 'image_url', 'slug', 'is_active', 'created_at', 'updated_at']);

it('can render table columns', function (string $column) {
    livewire(ListCategories::class)
        ->assertCanRenderTableColumn($column);
})->with(['name', 'image_url', 'slug', 'is_active', 'created_at', 'updated_at']);

it('can sort table columns', function (string $column) {
    $records = Category::factory(5)->create();

    livewire(ListCategories::class)
        ->sortTable($column)
        ->assertCanSeeTableRecords($records->sortBy($column), inOrder: true)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder: true);
})->with(['name']);

it('can search by name and slug', function (string $column) {
    $records = Category::factory(5)->create();
    $value = $records->first()->{$column};

    livewire(ListCategories::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['name', 'slug']);

it('can create a new category', function () {
    $record = Category::factory()->make();

    livewire(CreateCategory::class)
        ->fillForm([
            'name' => $record->name,
            'is_active' => $record->is_active,
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('categories', [
        'name' => $record->name,
        'slug' => Str::slug($record->name),
        'is_active' => $record->is_active,
    ]);
});

it('can update an existing category', function () {
    $record = Category::factory()->create();
    $newRecord = Category::factory()->make();

    livewire(EditCategory::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'name' => $newRecord->name,
            'is_active' => $newRecord->is_active,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('categories', [
        'id' => $record->id,
        'name' => $newRecord->name,
        'is_active' => $newRecord->is_active,
    ]);
});

it('can delete a category without products', function () {
    $record = Category::factory()->create();

    livewire(EditCategory::class, ['record' => $record->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($record);
});

it('can bulk delete categories without products', function () {
    $records = Category::factory(5)->create();

    livewire(ListCategories::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $records);

    foreach ($records as $record) {
        $this->assertModelMissing($record);
    }
});

it('validates the required name field', function () {
    livewire(CreateCategory::class)
        ->fillForm(['name' => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors(['name' => ['required']]);
});

it('validates the maximum length for name', function () {
    livewire(CreateCategory::class)
        ->fillForm(['name' => Str::random(256)])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors(['name' => ['max:255']]);
});

// TODO: тесты для slug
