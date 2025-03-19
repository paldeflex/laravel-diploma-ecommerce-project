<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Оплата - Снежинские краски')]
class CheckoutPage extends Component
{
    public $firstName;
    public $lastName;
    public $phone;
    public $address;
    public $city;
    public $region;
    public $zipCode;
    public $paymentMethod;

    private function addImageUrlToCartItems($cartItems): array
    {
        foreach ($cartItems as &$item) {
            $item['image_url'] = $item['image']
                ? url('storage', $item['image'])
                : asset('images/product-not-found.webp');
        }
        return $cartItems;
    }

    public function placeOrder(): void
    {
        $this->validate([
           'firstName' => 'required|string|max:255',
           'lastName' => 'required|string|max:255',
           'phone' => 'required|string|max:255',
           'address' => 'required|string|max:255',
           'city' => 'required|string|max:255',
           'region' => 'required|string|max:255',
           'zipCode' => 'required|string|max:255',
           'paymentMethod' => 'required|string|max:255',
        ]);
    }

    protected function validationAttributes(): array
    {
        return [
            'firstName' => 'имя',
            'lastName' => 'фамилия',
            'phone' => 'телефон',
            'address' => 'адрес',
            'city' => 'город',
            'region' => 'область',
            'zipCode' => 'почтовый индекс',
            'paymentMethod' => 'способ оплаты',
        ];
    }


    public function render()
    {
        $cartItems = CartManagement::getCartItemsFromCookie();
        $cartItems = $this->addImageUrlToCartItems($cartItems);
        $grandTotal = CartManagement::calculateGrandTotal($cartItems);
        return view('livewire.checkout-page', [
            'cartItems' => $cartItems,
            'grandTotal' => $grandTotal,
            'paymentMethods' => PaymentMethod::cases(),
        ]);
    }
}
