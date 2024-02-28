import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

document.querySelectorAll('.btnModel').forEach(button => {
    button.addEventListener('click', function () {
        // ottengo l'ID di restaurant associato al bottone
        const restaurantId = this.dataset.restaurantId;
        // modifico l'action del form di eliminazione e includo l'ID di restaurant
        document.querySelector(`#deleteForm${restaurantId}`).action = `{{ route('admin.restaurants.destroy', '') }}/${restaurantId}`;
    });
});
