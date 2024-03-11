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
        this.getImage = functions.getImage



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
        getFormValue(id) {
            if (document.getElementById(id)) {
                return document.getElementById(id).value
            }
            else {
                return "nada"
            }
        }
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
                    <h1 class="textYellow text-center mb-5 fw-bolder">CHECKOUT</h1>
                    <!-- nome ristorante corrente  -->
                    <div class="d-flex justify-content-center gap-5">
                        <div class="text-center">
                            <h3 class="">Stai ordinando da:</h3>
                            <h2 class="textYellow">{{ this.store.restaurants[getStorageValue('restaurant_id') - 1]?.name
                                }}</h2>
                        </div>
                        <div class="text-center">
                            <h3 class="">Totale</h3>
                            <h2 class="textYellow"> € {{ this.cartTotal() }}</h2>
                        </div>
                    </div>

                    <div>
                        <h2 class="textYellow fw-bolder mt-5">Prodotti:</h2>
                        <hr class="my-3 bgYellow">

                        <!-- stampo tutti i prodotti in carrello  -->
                        <div v-for="prodotto in this.store.products" class="col-6 my-5">
                            <!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
                            <div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">
                                <!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
                                <div class="row">
                                    <!-- Immagine singolo prodotto -->
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="boxImg">
                                            <img class="imgCart mb-5" :src="this.getImage(prodotto?.img)" alt="">
                                        </div>
                                    </div>
                                    <!-- Nome, prezzo e button rimuovi singolo prodotto -->
                                    <div class="col-3 d-flex flex-column justify-content-center">
                                        <router-link
                                            :to="{ name: 'restaurant-detail', params: { id: prodotto?.restaurant_id } }">
                                            <span class="col-6 fs-4 cart-title">
                                                {{ prodotto.name }}
                                            </span>
                                        </router-link>
                                        <div class="fw-bold my-2"> € {{ Math.round(((prodotto.price *
            this.getStorageValue(prodotto.id)) + Number.EPSILON) * 100) / 100 }}
                                        </div>
                                    </div>
                                    <!-- Button aggiungi e rimuovi prodotto -->
                                    <div
                                        class="col-3 d-flex flex-column aling-items-center justify-content-center text-center">

                                        <!-- Aggiunge prodotto -->
                                        <span class="add">
                                            <span class="circle-icon btn" @click="this.cartAddElement(prodotto)">
                                                <font-awesome-icon icon="fa-solid fa-plus" />
                                            </span>
                                        </span>
                                        <!-- Numero totale prodotti -->
                                        <span class="counter my-2 fw-bold" :data-id="prodotto.id"
                                            :data-name="prodotto.name" :id="prodotto.id + 'span'">
                                            {{ this.getStorageValue(prodotto.id) ?? 0 }}</span>
                                        <!-- Rimuove prodotto -->
                                        <span class="remove">
                                            <span class="circle-icon btn"
                                                @click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">
                                                <font-awesome-icon icon="fa-solid fa-minus" />
                                            </span>
                                        </span>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <!-- Rimuove tutti i prodotti nel carrello -->
                                        <div>

                                            <p class="btn btn-dark text-danger rounded-pill"
                                                @click="fullCartRemoveElement(prodotto)">Rimuovi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- form DATI UTENTE  -->
                    <div class="container">
                        <div class="row">


                            <h2 class="mt-5 textYellow">Inserisci i tuoi dati per completare l'ordine</h2>
                            <hr class="my-3 bgYellow">
                            <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm"
                                class="needs-validation col-8">

                                <!-- NAME -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(name), 'has-success': formData.name }]">
                                    <label for="name" class="form-label">Nome <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control py-3 rounded-pill" id="name" name="name"
                                        v-model="formData.name" required>
                                </div>
                                <!-- LASTNAME  -->

                                <div
                                    :class="['mb-3', { 'has-error': !validateField(lastname), 'has-success': formData.lastname }]">
                                    <label for="lastname" class="form-label">Cognome <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control py-3 rounded-pill" id="lastname"
                                        name="lastname" v-model="formData.lastname" required>
                                </div>

                                <!-- EMAIL  -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(email), 'has-success': formData.email }]">
                                    <label for="email" class="form-label">email <span
                                            style="color: red;">*</span></label>
                                    <input type="email" class="form-control py-3 rounded-pill" id="email" name="email"
                                        v-model="formData.email" required>
                                </div>
                                <!-- TELEPHONE -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(telephone), 'has-success': formData.telephone }]">
                                    <label for="telephone" class="form-label">telefono <span
                                            style="color: red;">*</span></label>
                                    <input type="number" class="form-control py-3 rounded-pill" id="telephone"
                                        name="telephone" v-model="formData.telephone" required>
                                </div>
                                <!-- ADDRESS -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(address), 'has-success': formData.address }]">
                                    <label for="address" class="form-label">indirizzo <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control py-3 rounded-pill" id="address"
                                        name="address" v-model="formData.address" required>
                                </div>
                                <!-- CITTA' -->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(city), 'has-success': formData.city }]">
                                    <label for="city" class="form-label">Città <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control py-3 rounded-pill" id="city" name="city"
                                        v-model="formData.city" required>
                                </div>
                                <!-- NOTE trasformare in textarea-->
                                <div
                                    :class="['mb-3', { 'has-error': !validateField(notes), 'has-success': formData.notes }]">
                                    <label for="notes" class="form-label">Note</label>
                                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control py-3"
                                        v-model="formData.notes"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center col-8 py-5">

                        <button :disabled="!isFormValid" class="btn btn-warning rounded-pill text-white"
                            @click="createBraintree()">Seleziona la
                            modalità di pagamento <font-awesome-icon :icon="['fas', 'money-bill']" /></button>
                    </div>
                    <!-- BRAINTREE  -->
                    <div id="braintreeContainer">
                        <div id="dropin-container" class="col-8"></div>
                    </div>

                    <!-- bottone submit per confermare i dati di pagamento  -->
                    <div class="d-flex justify-content-center col-8 ">

                        <button :disabled="!isFormValid" id="submit-button"
                            class="btn button--small button--green d-none rounded-pill">Conferma
                            Selezione</button>
                    </div>



                    <div class="d-flex justify-content-center">
                        <button :disabled="!isFormValid || !isPaymentValid"
                            class="btn btn-danger my-5 rounded-pill px-4 py-3 fw-bolder" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" @click="confirmOrder">CONFERMA
                            ORDINE <font-awesome-icon icon="fa-solid fa-cart-shopping" /></button>
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
                                    <h5 class="mb-5">Grazie <span class="fw-bolder fs-4">{{ getFormValue('name')
                                            }}</span>,
                                        il tuo ordine è stato completato
                                        con
                                        <span class="text-success fw-bolder fs-4">successo</span>!
                                    </h5>
                                    <p>Importo pagato: <span class="text-success fw-bolder">€ {{ this.cartTotal() }}
                                        </span>
                                    </p>
                                    <p>Indirizzo: <span class="fw-bolder">{{ getFormValue('address') }}, {{
                                            getFormValue('city') }}</span></p>

                                    <h5 class="mt-5"> stai per essere reindirizzato alla HOME.</h5>
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


// BRAINTREE 


.braintree-dropin div,
.braintree-dropin,
.braintree-loaded .braintree-upper-container:before {
    color: white !important;
    font-weight: 600;
    // background-color: rgb(38, 36, 36) !important;
    background-color: black;
    border-radius: 2rem;
    border-width: 3px;
}

.braintree-form-number,
.braintree-form__hosted-field {
    background-color: white !important;
    padding: 0 2rem;
    border-radius: 2rem;
    border-width: 2px;
}

.braintree-methods--active:not(.braintree-methods--edit) .braintree-method--active .braintree-method__label {
    padding-left: 1rem;
}

.braintree-large-button,
.braintree-toggle {
    display: none !important;
}

.braintree-form__notice-of-collection,
.braintree-placeholder {
    display: none;
}

.braintree-sheet__header {
    padding: 1.5rem 3rem 0.5rem 3rem;
    align-items: center;
    justify-content: center;
}


.braintree-form__label {
    // color: white !important;
    font-weight: bolder !important;
}
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
#notes {
    border-radius: 1rem;
}

.has-error input {
    border-color: red !important;
    border-width: 2px;
}

.has-success input {
    border-color: green !important;
    border-width: 2px;
}

/* immagini e box */
.boxImg {
    width: 8rem;
    height: 6rem;
    overflow: hidden;
    border-radius: 25px;
}

.imgCart {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 25px;
    transition: transform 0.2s;
}

.boxImg:hover .imgCart {
    transform: scale(1.1);
}

.circle-icon {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ff9900;
    color: black;
    font-size: 16px;
    cursor: pointer;
    transition: transform 0.2s;
}

.circle-icon:hover {
    background-color: #ff9900;
    color: black;
    transform: scale(1.2);
}

.cartName {
    color: #ff9900;
}


.btnCart {
    padding: 9px;
    margin-top: 30px;
    background-color: #066e7c;
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    font-size: 14px;
    transition: transform 0.2s;
}

.btnCart:hover {
    transform: scale(1.1);
}

.btnYellow {
    background-color: #ff9900;
    color: black;
}
</style>