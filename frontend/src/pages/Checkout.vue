<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import functions from '../functions.js'
import * as bootstrap from "bootstrap";
import { router } from '../router.js';



export default {
    name: "Checkout",
    data() {
        return {
            store,
            error: false,
            formData: {
                name: '',
                lastname: '',
                email: '',
                telephone: '',
                notes: '',
                city: '',
                address: ''


            },
            isPaymentValid: false // Aggiunto per tenere traccia dello stato di validità del pagamento
        }
    },
    computed: {
        isFormValid() {
            // Verifichiamo che tutti i campi siano validi
            return Object.values(this.formData).every(field => !!field);
        }
    },
    created() {
        this.clearCart = functions.clearCart // recupera funzione in gunction.js
        this.aggiornaCounter = functions.aggiornaCounter
        this.ArrayCart = functions.ArrayCart
        this.hideMinButton = functions.hideMinButton
        this.cartAddElement = functions.cartAddElement
        this.cartRemoveElement = functions.cartRemoveElement
        this.fullCartRemoveElement = functions.fullCartRemoveElement
        this.getStorageValue = functions.getStorageValue
        this.cartCounter = functions.cartCounter
        this.cartTotal = functions.cartTotal



    },
    beforeMount() {
    },
    mounted() {

        if (this.cartCounter() == 0) {
            this.error = true
        }

        let braintreeScript = document.createElement('script')
        braintreeScript.setAttribute('src', 'https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.js')
        document.head.appendChild(braintreeScript)


    },
    updated() {


    },
    methods: {
        validateField(field) {
            // Funzione per la validazione di un campo
            return !!field;
        },
        submitForm() {
            // Gestione dell'invio del form
            if (this.isFormValid) {
                // Esegui azioni per inviare il form
                this.confirmOrder();
            } else {
                // Gestisci l'errore, ad esempio visualizza un messaggio di errore
                console.log('Compila tutti i campi obbligatori.');
            }
        },
        createBraintree() {
            var button = document.getElementById("submit-button")
            button.classList.remove("d-none")
            braintree.dropin.create({
                authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
                selector: '#dropin-container'
            }, (err, instance) => {
                button.addEventListener('click', () => {
                    instance.requestPaymentMethod((err, payload) => {
                        if (err) {
                            // Gestisci eventuali errori
                            console.error(err);
                            this.isPaymentValid = false;
                        } else {
                            // La carta di credito è stata validata con successo
                            this.isPaymentValid = true;
                        }
                    });
                });
            });
        },
        getDataOggi() {
            const oggi = new Date();
            const anno = oggi.getFullYear();
            let mese = oggi.getMonth() + 1; // i mesi partono da 0 (0 = gennaio)
            mese = mese < 10 ? '0' + mese : mese; // aggiunge lo zero davanti se il mese è inferiore a 10
            let giorno = oggi.getDate();
            giorno = giorno < 10 ? '0' + giorno : giorno; // aggiunge lo zero davanti se il giorno è inferiore a 10

            return `${anno}-${mese}-${giorno}`;
        },
        confirmOrder() {
            const products = [];
            this.store.ArrayIdsInCart.forEach(id => {
                // Controlla di ciclare solo sugli id dei prodotti
                if (id !== 'restaurant_id') {
                    products.push({
                        id: id,
                        quantity: parseInt(localStorage.getItem(id))
                    });
                }
            });

            const formData = {
                total_price: this.cartTotal(),
                date: this.getDataOggi(),
                notes: document.getElementById("notes").value,
                guest_name: document.getElementById("name").value,
                guest_surname: document.getElementById("lastname").value,
                guest_telephone: document.getElementById("telephone").value,
                guest_email: document.getElementById("email").value,
                guest_address: document.getElementById("address").value,
                guest_city: document.getElementById("city").value,
                products: products
            };
            axios.post('http://localhost:8000/api/orders', formData)
                .then(response => {
                    // Gestisci la risposta dal server, ad esempio visualizzando un messaggio di successo
                    console.log(response.data);
                })
                .catch(error => {
                    // Gestisci gli errori, ad esempio visualizzando un messaggio di errore
                    console.error(error.response.data);
                });
            setTimeout(() => {

                this.clearCart()

                router.push({ name: 'home' })

                var myModalEl = document.getElementById('staticBackdrop');
                var modal = bootstrap.Modal.getInstance(myModalEl)
                modal.hide();
                const myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.hide();

            }, 4000)


        },

    }
}
</script>

<template>
    <div class="container">

        <!-- controllo se il carrello è pieno -->
        <div v-if="this.cartCounter() > 0">

            <!-- controllo se la chiamata axios è andata a buon fine  -->
            <div v-if="error">
                <h1>Si è verificato un errore</h1>
            </div>
            <div v-else>

                <!-- controllo se il ristorante è completamente caricato  -->
                <div v-if="!this.store.restaurants[getStorageValue('restaurant_id') - 1]"
                    class="d-flex justify-content-center align-items-center">
                    <h1>Caricamento.. <div class="loader d-inline-block"></div>
                    </h1>
                </div>
                <div v-else>

                    <!------------------------------------ CORPO PAGINA  ------------------------------------------------->
                    <h1>checkout TOTALE->{{ this.cartTotal() }}€</h1>
                    <!-- nome ristorante corrente  -->
                    <h2>{{ this.store.restaurants[getStorageValue('restaurant_id') - 1]?.name }}</h2>

                    <div>

                        <!-- stampo tutti i prodotti in carrello  -->
                        <div v-for="prodotto in this.store.products">

                            <!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
                            <div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">

                                <!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
                                <span>{{ prodotto.name }} ({{ prodotto.price }}) -> <span class="counter"
                                        :data-id="prodotto.id" :data-name="prodotto.name" :id="prodotto.id + 'span'">{{
            this.getStorageValue(prodotto.id) ?? 0 }}</span></span>
                                <button class="btn btn-primary add" @click="this.cartAddElement(prodotto)">+</button>
                                <button class="btn btn-danger remove"
                                    @click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">-</button>
                                <a href="#" @click="fullCartRemoveElement(prodotto)">rimuovi</a>

                            </div>
                        </div>
                    </div>

                    <!-- form DATI UTENTE  -->
                    <div class="container">
                        <div class="row">


                            <h2 class="mt-5">Inserisci i tuoi dati per completare l'ordine</h2>
                            <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm"
                                class="needs-validation col-8">

                                <!-- NAME -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(name), 'has-success': formData.name }]">
                                    <label for="name" class="form-label">Nome <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        v-model="formData.name" required>
                                </div>
                                <!-- LASTNAME  -->

                                <div
                                    :class="['mb-3', { 'has-error': !validateField(lastname), 'has-success': formData.lastname }]">
                                    <label for="lastname" class="form-label">Cognome <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        v-model="formData.lastname" required>
                                </div>

                                <!-- EMAIL  -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(email), 'has-success': formData.email }]">
                                    <label for="email" class="form-label">email <span
                                            style="color: red;">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        v-model="formData.email" required>
                                </div>
                                <!-- TELEPHONE -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(telephone), 'has-success': formData.telephone }]">
                                    <label for="telephone" class="form-label">telefono <span
                                            style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="telephone" name="telephone"
                                        v-model="formData.telephone" required>
                                </div>
                                <!-- ADDRESS -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(address), 'has-success': formData.address }]">
                                    <label for="address" class="form-label">indirizzo <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        v-model="formData.address" required>
                                </div>
                                <!-- CITTA' -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(city), 'has-success': formData.city }]">
                                    <label for="city" class="form-label">città <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        v-model="formData.city" required>
                                </div>
                                <!-- NOTE trasformare in textarea-->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(notes), 'has-success': formData.notes }]">
                                    <label for="notes" class="form-label">Note <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="notes" name="notes"
                                        v-model="formData.notes" required>
                                </div>
                            </form>
                        </div>
                    </div>

                    <button :disabled="!isFormValid" class="btn btn-primary" @click="createBraintree()">Seleziona la
                        modalità di pagamento</button>
                    <!-- BRAINTREE  -->
                    <div id="braintreeContainer">
                        <div id="dropin-container" class="col-8"></div>
                    </div>

                    <!-- bottone submit per confermare i dati di pagamento  -->
                    <button :disabled="!isFormValid" id="submit-button"
                        class="btn button--small button--green d-none">Conferma
                        Selezione</button>



                    <div class="d-flex justify-content-center">
                        <button :disabled="!isFormValid || !isPaymentValid" class="btn btn-danger my-5"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop" @click="confirmOrder">CONFERMA
                            ORDINE</button>
                    </div>


                    <!-- MODAL CONFERMA ORDINE  -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div id="myModal" class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ORDINE COMPLETATO</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Ordine Completato con successo! stai per essere reindirizzato alla HOME.
                                </div>

                            </div>
                        </div>
                    </div>

                    <!------------------------------------------- FINE CORPO PAGINA  ------------------------------------->
                </div>
            </div>
        </div>
        <div v-else>
            <h1>Non hai selezionato nessun prodotto nel carrello</h1>
        </div>
    </div>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use '../styles/general.scss';
</style>

<style scoped lang="scss">
// BRAINTREE 

.button {
    cursor: pointer;
    font-weight: 500;
    left: 3px;
    line-height: inherit;
    position: relative;
    text-decoration: none;
    text-align: center;
    border-style: solid;
    border-width: 1px;
    border-radius: 3px;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: inline-block;
}

.button--small {
    padding: 10px 20px;
    font-size: 0.875rem;
}

.button--green {
    outline: none;
    background-color: #64d18a;
    border-color: #64d18a;
    color: white;
    transition: all 200ms ease;
}

.button--green:hover {
    background-color: #8bdda8;
    color: white;
}


// LOADER -->se si usa altrove mettere in general scss
.loader {
    border: 0.5rem solid #f3f3f3;
    /* Light grey */
    border-top: 0.5rem solid #3498db;
    /* Blue */
    border-radius: 50%;
    aspect-ratio: 1;
    height: 2rem;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}


// CSS VALIDAZIONE 
.has-error input {
    border-color: red !important;
    border-width: 2px;
}

.has-success input {
    border-color: green !important;
    border-width: 2px;
}
</style>