import * as bootstrap from "bootstrap";


export default {
    cartCounter: function() {
        //quantità totale carrello a 0
        let quantities = 0
        //ciclo sull'array nello store che contiene tutti gli id dei prodotti nel carrello
        this.store.ArrayIdsInCart.forEach(element => {
            // controllo che la chiave non sia il restaurant id
            if (element != 'restaurant_id') {
                //recupero il valore associato alla chiave e lo strasformo in un numero, era una stringa
                let value = parseInt(localStorage.getItem(element))
                // a ogni giro sommo la quantità corrente con quella totale fuori dal ciclo 
                quantities += value
            }
        });
        return quantities
    },
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
    // aggiorna l'array nello store con gli id dei prodotti nel carrello 
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

        var valore = Number(localStorage.getItem(id))

        // seleziono il bottone - 
        const minBtn = document.querySelectorAll(`#product-${id} .remove`);

        minBtn.forEach(btn => {

            if(btn) {
                if (valore == 0) {
                    btn.classList.add("d-none")
                } else {
                    if (btn.classList.contains("d-none")) {
                        btn.classList.remove("d-none")
        
                    }
                }
            }
            
        });

        
    },
    //funzione che aggiunge elementi alla lista dei prodotti selezionati
    cartAddElement: function (product) {

        // controllo se il ristorante corrente è vuoto o se è uguale a quello del prodotto che voglio inserire 
       if (localStorage.getItem("restaurant_id") == null || product.restaurant_id == localStorage.getItem("restaurant_id")) {

        // se entra pusho l'id del ristorante corrente nel local storage 
        localStorage.setItem("restaurant_id", product.restaurant_id)

        
        
            // recupero il valore della quantità
            let quantity = Number(localStorage.getItem(product.id))
            //incremento la quantità
            quantity++
            // salvo la coppia nome-quantità nel local storage 
            localStorage.setItem(product.id, quantity)

        this.ArrayCart()

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

        // recupero il valore della quantità
        let quantity = Number(localStorage.getItem(product.id))
        // controllo che la quantità sia maggiore di 0, e in caso decremento, altrimenti setto il valore a 0 
        if (quantity > 0) {
            quantity--

            if (quantity != 0) {
                localStorage.setItem(product.id, quantity)

            } else {
                localStorage.removeItem(product.id)

            }
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
        this.ArrayCart()
        //se l'unico elemento del localstorage è il restaurant id allora lo rimuovo
        if (localStorage.length == 1) {
            localStorage.removeItem("restaurant_id")
        }
        
    },
    currentValue: function(prodotto) {
        let value = 0
        //ciclo sull'array nello store che contiene tutti gli id dei prodotti nel carrello
        this.store.ArrayIdsInCart.forEach(element => {
            // controllo che la chiave non sia il restaurant id
            if (element == prodotto.id) {
                //recupero il valore associato alla chiave e lo strasformo in un numero, era una stringa
                value = parseInt(localStorage.getItem(element))
                // a ogni giro sommo la quantità corrente con quella totale fuori dal ciclo 
            }
        });
        return value
    },
    cartTotal: function() {
        let total=0
        this.store.ArrayIdsInCart.forEach(element => {
            if (element != 'restaurant_id') {

                // trasformo l'id in un numero (forse non serve ma non ho voglia di controllare)
                const id=parseInt(element) 
                // recuper il costo del prodotto 
                const price=this.store.products[id-1]?.price
                //recupero il valore associato alla chiave e lo strasformo in un numero, era una stringa
                const value = parseInt(localStorage.getItem(element))
                // a ogni giro sommo la quantità corrente con quella totale fuori dal ciclo 
                let partialSum=price*value
                total += partialSum
            }
        });
        return Math.round((total + Number.EPSILON) * 100) / 100
    }
}