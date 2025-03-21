<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Категории - Снежинские краски')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)
            ->whereHas('products', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        return view('livewire.categories-page', [
            'categories' => $categories,
        ]);
    }
}
