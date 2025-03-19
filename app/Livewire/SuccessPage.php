<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Заказ успешно оформлен - Снежинские краски')]
class SuccessPage extends Component
{

    public function render()
    {
        $latestOrder = Order::with('address')->where('user_id', auth()->id())->latest()->first();
        return view('livewire.success-page', [
            'order' => $latestOrder,
        ]);
    }



//    public $orderId;

//    public function mount()
//    {
//        if (!session()->has('order_completed_id')) {
//            return redirect()->route('checkout');
//        }
//
//        session()->forget('order_completed_id');
//    }
}
