<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Мои заказы - Снежинские краски')]
class MyOrdersPage extends Component
{
    use withPagination;

    public function render()
    {
        $myOrders = Order::where('user_id', auth()->user()->id)->latest()->paginate(20);

        return view('livewire.my-orders-page', [
            'orders' => $myOrders,
        ]);
    }
}
