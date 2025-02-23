<?php

use App\Filament\Resources\CoatingTypeResource\Pages\CreateCoatingType;
use App\Filament\Resources\CoatingTypeResource\Pages\EditCoatingType;
use App\Filament\Resources\CoatingTypeResource\Pages\ListCoatingTypes;
use App\Models\CoatingType;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(function () {
    DB::table('coating_types')->truncate();
});

it('can display the coating type list page', function () {
    livewire(ListCoatingTypes::class)
        ->assertSuccessful();
});

it('can display the coating type creation page', function () {
    livewire(CreateCoatingType::class)
        ->assertSuccessful();
});

it('can display the coating type editing page', function () {
    $record = CoatingType::factory()->create();

    livewire(EditCoatingType::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

it('displays the required columns in the table', function (string $column) {
    livewire(ListCoatingTypes::class)
        ->assertTableColumnExists($column);
})->with(['name', 'slug', 'is_active', 'created_at', 'updated_at']);

it('can render table columns', function (string $column) {
    livewire(ListCoatingTypes::class)
        ->assertCanRenderTableColumn($column);
})->with(['name', 'slug', 'is_active', 'created_at', 'updated_at']);

it('can sort table columns', function (string $column) {
    $records = CoatingType::factory(5)->create();

    livewire(ListCoatingTypes::class)
        ->sortTable($column)
        ->assertCanSeeTableRecords($records->sortBy($column), inOrder: true)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder: true);
})->with(['name']);

it('can search by table columns', function (string $column) {
    $records = CoatingType::factory(5)->create();
    $value = $records->first()->{$column};

    livewire(ListCoatingTypes::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['name', 'slug']);

it('can create a new coating type', function () {
    $record = CoatingType::factory()->make();

    livewire(CreateCoatingType::class)
        ->fillForm([
            'name' => $record->name,
            'is_active' => $record->is_active,
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('coating_types', [
        'name' => $record->name,
        'slug' => Str::slug($record->name),
        'is_active' => $record->is_active,
    ]);
});

it('can update an existing coating type', function () {
    $record = CoatingType::factory()->create();
    $newRecord = CoatingType::factory()->make();

    livewire(EditCoatingType::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'name' => $newRecord->name,
            'is_active' => $newRecord->is_active,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('coating_types', [
        'id' => $record->id,
        'name' => $newRecord->name,
        'is_active' => $newRecord->is_active,
    ]);
});

it('can delete a coating type', function () {
    $record = CoatingType::factory()->create();

    livewire(EditCoatingType::class, ['record' => $record->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($record);
});

it('can bulk delete coating types', function () {
    $records = CoatingType::factory(5)->create();

    livewire(ListCoatingTypes::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $records);

    foreach ($records as $record) {
        $this->assertModelMissing($record);
    }
});

it('validates the required name field', function () {
    livewire(CreateCoatingType::class)
        ->fillForm(['name' => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors(['name' => ['required']]);
});

it('validates the maximum length for name', function () {
    livewire(CreateCoatingType::class)
        ->fillForm(['name' => Str::random(256)])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors(['name' => ['max:255']]);
});
