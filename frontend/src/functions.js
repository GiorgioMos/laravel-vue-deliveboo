export default {
    riempiCarrello: function () {
        const container = document.getElementById("offcanvas-body");
        container.innerHTML = "";
        let isEmpty = true; // Flag per verificare se il carrello è vuoto

        for (let i = 0; i < localStorage.length; i++) {
            let key = localStorage.key(i);
            let value = localStorage.getItem(key);

            // Verifica se il valore è maggiore di zero
            if (parseInt(value) > 0 && key!=="restaurant_id") {
                isEmpty = false; // Il carrello non è vuoto

                var newElement = document.createElement("div");
                newElement.setAttribute("id", key);
                newElement.innerHTML = key + " : " + value;
                container.appendChild(newElement);
            }
        }
    },
    clearCart: function (store) {
        localStorage.clear();
        store == ""
    },
}