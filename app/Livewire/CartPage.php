<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[title('Корзина - Снежинские краски')]
class CartPage extends Component
{
    public $cartItems = [];
    public $grandTotal;

    private function addImageUrlToCartItems(): void
    {
        foreach ($this->cartItems as &$item) {
            $item['image_url'] = $item['image']
                ? url('storage', $item['image'])
                : asset('images/product-not-found.webp');
        }
    }

    public function increaseQty($id): void
    {
        $this->cartItems = CartManagement::incrementQuantityToCartItem($id);
        $this->addImageUrlToCartItems();
        $this->grandTotal = CartManagement::calculateGrandTotal($this->cartItems);
    }

    public function decreaseQty($id): void
    {
        $this->cartItems = CartManagement::decrementQuantityToCartItem($id);
        $this->addImageUrlToCartItems();
        $this->grandTotal = CartManagement::calculateGrandTotal($this->cartItems);
    }

    public function mount(): void
    {
        $this->cartItems = CartManagement::getCartItemsFromCookie();
        $this->addImageUrlToCartItems();
        $this->grandTotal = CartManagement::calculateGrandTotal($this->cartItems);
    }

    public function removeItem($id): void
    {
        $this->cartItems = CartManagement::removeItemFromCart($id);
        $this->addImageUrlToCartItems();
        $this->grandTotal = CartManagement::calculateGrandTotal($this->cartItems);
        $this->dispatch('updateCartCount', count($this->cartItems))->to(Navbar::class);
    }
    public function render()
    {
        return view('livewire.cart-page');
    }
}
