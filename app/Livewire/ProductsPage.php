<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\CoatingType;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Каталог продукции антикоррозионных покрытий: грунтовка от коррозии, грунт-эмаль, краска грунтовка, лаки')]
class ProductsPage extends Component
{
    public $perPage = 12;
    public $categoriesToShow = 4;
    public $coatingTypesToShow = 8;

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function loadMoreCategories(): void
    {
        $this->categoriesToShow += 12;
    }

    public function loadMoreCoatingTypes(): void
    {
        $this->coatingTypesToShow += 12;
    }

    public function render()
    {
        return view('livewire.products-page', [
            'products' => Product::where('is_active', 1)
                ->orderByDesc('updated_at')
                ->paginate($this->perPage),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
            'coatingTypes' => CoatingType::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
