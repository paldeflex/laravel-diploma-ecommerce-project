import './bootstrap';
import 'preline';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

window.notyf = new Notyf({
    duration: 2500,
    position: { x: 'right', y: 'bottom' },
});

document.addEventListener('livewire:init', () => {
    Livewire.on('product-added', () => {
        window.notyf.success('Товар добавлен в корзину');
    });
});

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
});
