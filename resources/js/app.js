import './bootstrap';
import 'preline'
import Swal from 'sweetalert2'

window.Swal = Swal

document.addEventListener('livewire:init', () => {
    Livewire.on('showAlert', (data) => {
        Swal.fire({
            icon: data[0].icon || 'success',
            title: data[0].title || '',
            text: data[0].text || '',
            position: data[0].position || 'center',
            timer: data[0].timer || null,
            toast: data[0].toast || false,
            showConfirmButton: data[0].showConfirmButton || false,
            showCancelButton: data[0].showCancelButton || false,
            showDenyButton: data[0].showDenyButton || false,
            ...data[0].options
        });
    });
});


document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
});
