<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\CoatingType;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Снежинские краски - Завод лакокрасочных материалов, производство и оптовые поставки антикоррозионных и огнезащитных ЛКМ')]
class HomePage extends Component
{
    public function render()
    {
        $coatingTypes = CoatingType::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)
            ->whereHas('products', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        return view('livewire.home-page',
            [
                'coatingTypes' => $coatingTypes,
                'categories' => $categories,
            ]
        );
    }
}
