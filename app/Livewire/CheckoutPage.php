<?php

namespace App\Livewire;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
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

    public function mount()
    {
        $cartItems = CartManagement::getCartItemsFromCookie();

        if(count($cartItems) == 0) {
            return redirect(route('products'));
        }
    }

    private function addImageUrlToCartItems($cartItems): array
    {
        foreach ($cartItems as &$item) {
            $item['image_url'] = $item['image']
                ? url('storage', $item['image'])
                : asset('images/product-not-found.webp');
        }
        return $cartItems;
    }

    public function placeOrder()
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

        $cartItems = CartManagement::getCartItemsFromCookie();
        $cartItems = $this->addImageUrlToCartItems($cartItems);

        $orderItems = [];
        foreach ($cartItems as $item) {
            $orderItems[] = [
                'product_id' => $item['id'], // ID продукта
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unitAmount'] ?? 0,
                'total_amount' => ($item['unitAmount'] ?? 0) * ($item['quantity'] ?? 1),
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cartItems);
        $order->payment_method = $this->paymentMethod;
        $order->payment_status = PaymentStatus::PENDING;
        $order->status = OrderStatus::NEW;
        $order->shipping_amount = 0;
        $order->shipping_method = ShippingMethod::NONE;
        $order->notes = 'Заказ размещен пользователем ' . auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->firstName;
        $address->last_name = $this->lastName;
        $address->phone = $this->phone;
        $address->street_address = $this->address;
        $address->city = $this->city;
        $address->region = $this->region;
        $address->zip_code = $this->zipCode;
        $address->user_id = auth()->user()->id;

        $redirectUrl = '';

        if ($this->paymentMethod == PaymentMethod::YOOKASSA) {
            // TODO: необходимо реализовать оплату ЮКассы
        } else {
            $redirectUrl = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();

        $order->items()->createMany($orderItems);

        CartManagement::clearCartItemsFromCookie();
        Mail::to(request()->user())->send(new OrderPlaced($order));

        session()->put('order_completed_id', $order->id);

        return redirect($redirectUrl);
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
