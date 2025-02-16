<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;
use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Models\Category;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('can create a category', function () {
    $newData = [
        'name' => 'Тестовая категория',
        'slug' => Str::slug('Тестовая категория'),
        'is_active' => true,
    ];

    livewire(CreateCategory::class)
        ->fillForm($newData)
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Category::class, [
        'name' => 'Тестовая категория',
        'slug' => Str::slug('Тестовая категория'),
        'is_active' => true,
    ]);
});
