<?php

namespace App\Livewire;

use Livewire\Component;

class SuccessPage extends Component
{
    public $orderId;

    public function mount()
    {
        if (!session()->has('order_completed_id')) {
            return redirect()->route('checkout');
        }

        session()->forget('order_completed_id');
    }

    public function render()
    {
        return view('livewire.success-page');
    }
}
