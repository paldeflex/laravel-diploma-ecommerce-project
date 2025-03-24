<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Category;
use App\Models\CoatingType;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Каталог продукции антикоррозионных покрытий: грунтовка от коррозии, грунт-эмаль, краска грунтовка, лаки')]
class ProductsPage extends Component
{
    public $perPage = 12;

    public $categoriesToShow = 4;

    public $coatingTypesToShow = 8;

    #[Url]
    public $selectedCategories = [];

    #[Url]
    public $selectedCoatingTypes = [];

    #[Url]
    public $featured;

    #[Url]
    public $onSale;

    #[Url]
    public $priceRange;

    #[Url]
    public $sort = 'latest';

    public function addToCart($productId)
    {
        $totalCount = CartManagement::addItemToCart($productId);

        $this->dispatch('updateCartCount', $totalCount)->to(Navbar::class);
        $this->dispatch('product-added');
    }

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function mount()
    {
        $this->priceRange = Product::where('is_active', 1)->max('price');
    }

    public function loadMoreCategories(): void
    {
        $this->categoriesToShow += 12;
    }

    public function loadMoreCoatingTypes(): void
    {
        $this->coatingTypesToShow += 12;
    }

    public function resetCategoriesFilters(): void
    {
        $this->selectedCategories = [];
    }

    public function resetCoatingTypesFilters(): void
    {
        $this->selectedCoatingTypes = [];
    }

    public function render()
    {
        $productQuery = Product::where('is_active', 1);

        if (! empty($this->selectedCategories)) {
            $productQuery->whereIn('category_id', $this->selectedCategories);
        }

        if (! empty($this->selectedCoatingTypes)) {
            $productQuery->whereHas('coatingTypes', function ($q) {
                $q->whereIn('coating_types.id', $this->selectedCoatingTypes);
            });
        }

        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->onSale) {
            $productQuery->where('on_sale', 1);
        }

        if ($this->priceRange) {
            $productQuery->whereBetween('price', [0, $this->priceRange]);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        $minPrice = Product::where('is_active', 1)->min('price');
        $maxPrice = Product::where('is_active', 1)->max('price');

        $categories = Category::where('is_active', 1)
            ->whereHas('products', function ($query) {
                $query->where('is_active', 1);
            })
            ->get(['id', 'name', 'slug']);

        $coatingTypes = CoatingType::where('is_active', 1)
            ->whereHas('products', function ($query) {
                $query->where('is_active', 1);
            })
            ->get(['id', 'name', 'slug'])
            ->sortByDesc(function ($coatingType) {
                return in_array($coatingType->id, $this->selectedCoatingTypes);
            });

        $categories = $categories->sortByDesc(function ($category) {
            return in_array($category->id, $this->selectedCategories);
        });

        return view('livewire.products-page', [
            'products' => $productQuery->orderByDesc('updated_at')->paginate($this->perPage),
            'categories' => $categories,
            'coatingTypes' => $coatingTypes,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}
