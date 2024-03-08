import * as bootstrap from "bootstrap";


export default {
    clearCart: function () {
        localStorage.clear();
        this.store.ArrayIdsInCart=[]
    },
    aggiornaCounter: function () {
        let spans = document.querySelectorAll('.counter');

        if (localStorage.length != 0) {
            spans.forEach(element => {
                //ciclo sugli elementi nel local storage
                for (let i = 0; i < localStorage.length; i++) {
                    // seleziono la key 
                    let key = localStorage.key(i);
                    // recupero l'id del prodotto 
                    let id = element.getAttribute('data-id');
                    // salvo il valore corrispondente che si trova nel local storage in una variabile 
                    let value = localStorage.getItem(key);
                    // se l'id prodotto dello span è uguale a quello nel local storage gli sparo dentro il valore corrispondente 
                    if (id == key) {
                        document.querySelector(`span[data-id="${id}"]`).innerHTML = value
                    }

                }

                // recupero l'id 
                let id = element.getAttribute('data-id');
                // richiamo la funzione per nascondere il tasto meno, e gli passo l'id 
                this.hideMinButton(id)
            });
        } else {
            spans.forEach(element => {
                element.innerHTML = 0
                // recupero l'id 
                let id = element.getAttribute('data-id');
                // richiamo la funzione per nascondere il tasto meno, e gli passo l'id 
                this.hideMinButton(id)
            })
        }
    },
    // aggiorna l'array con i prodotti nel carrello 
    ArrayCart: function () {
        this.store.ArrayIdsInCart = Object.keys(localStorage)
        console.log(this.store.ArrayIdsInCart)
    },
    // recupera il valore di una chiave nel local storage
    getStorageValue: function (key) {
        return localStorage.getItem(key)
    },
    // nascondo il bottone se il valore è 0 
    hideMinButton: function (id) {
        var valore = document.getElementById(`${id}span`).innerHTML
        // seleziono il bottone - 
        const min = document.getElementById(`product-${id}`).getElementsByClassName("remove")[0]
        const min1 = document.getElementById(`product-${id}`).getElementsByClassName("remove")[1]

        if (valore == 0) {
            min.classList.add(
                "d-none")
                min1.classList.add(
                    "d-none")
        } else {
            if (min.classList.contains("d-none")) {

                min.classList.remove("d-none")
                min1.classList.remove("d-none")

            }
        }
    },
    //funzione che aggiunge elementi alla lista dei prodotti selezionati
    cartAddElement: function (product) {

        // controllo se il ristorante corrente è vuoto o se è uguale a quello del prodotto che voglio inserire 
        if (localStorage.getItem("restaurant_id") == null || product.restaurant_id == localStorage.getItem("restaurant_id")) {
            localStorage.setItem("restaurant_id", product.restaurant_id)

            // recupero il valore della quantità
            let quantity = Number(document.querySelector(`span[data-name="${product.name}"]`).innerHTML)
            //incremento la quantitù
            quantity++
            // salvo la coppia nome-quantità nel local storage 
            localStorage.setItem(product.id, quantity)
            // la sparo in pagina nello span relativo a quel prodotto
            document.querySelector(`span[data-name="${product.name}"]`).innerHTML = quantity
            this.ArrayCart()



            // richiamo la funzione che mi aggiorna i prodotti nel carrello 
            // this.riempiCarrello(product.name);
        } else {
            console.log("non si fa");

            // modal per non ordinare negli altri ristoranti
			// Recupera l'elemento del modal utilizzando document.querySelector o utilizzando un selettore Vue.js
			const modal = document.querySelector('.modal');
			// Apri il modal
			const modalInstance = new bootstrap.Modal(modal);
			modalInstance.show();

        }

    },
    //funzione che rimuove elementi alla lista dei prodotti selezionati
    cartRemoveElement: function (product) {
        let quantity = Number(document.querySelector(`span[data-id="${product.id}"]`).innerHTML)
        // controllo che la quantità sia maggiore di 0, e in caso decremento, altrimenti setto il valore a 0 
        if (quantity > 0) {
            quantity--

            if (quantity != 0) {
                localStorage.setItem(product.id, quantity)

            } else {
                localStorage.removeItem(product.id)

            }
            document.querySelector(`span[data-id="${product.id}"]`).innerHTML = quantity
            this.ArrayCart()

            //  this.riempiCarrello(product_name);

            //se l'unico elemento del localstorage è il restaurant id allora lo rimuovo
            if (localStorage.length == 1) {
                localStorage.removeItem("restaurant_id")
            }
        }

    },
    fullCartRemoveElement: function(product) {
        localStorage.removeItem(product.id)
        document.querySelector(`span[data-id="${product.id}"]`).innerHTML = 0
        this.ArrayCart()
        //se l'unico elemento del localstorage è il restaurant id allora lo rimuovo
        if (localStorage.length == 1) {
            localStorage.removeItem("restaurant_id")
        }
        
    }
}