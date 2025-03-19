<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Информация о продукте')]
class ProductDetailPage extends Component
{
    public $slug;

    public $quantity = 1;

    public function mount($slug)
    {
        return $this->slug = $slug;
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($productId): void
    {
        $totalCount = CartManagement::addItemToCartWithQuantity($productId, $this->quantity);

        $this->dispatch('updateCartCount', $totalCount)->to(Navbar::class);

        $this->dispatch('showCartNotification', [
            'message' => 'Товар добавлен в корзину',
            'type' => 'success',
        ]);

        LivewireAlert::title('Товар добавлен в корзину')
            ->success()
            ->position('bottom-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
