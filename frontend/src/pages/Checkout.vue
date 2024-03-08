<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import functions from '../functions.js'
import * as bootstrap from "bootstrap";



export default {
    name: "Checkout",
    data() {
        return {
            store,
            error: false,
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
        createBraintree() {
            var button = document.querySelector('#submit-button');
            button.classList.remove("d-none")
            braintree.dropin.create({
                authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
                selector: '#dropin-container'
            }, function (err, instance) {
                button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        // Submit payload.nonce to your server
                    });
                })
            });
        }
    }
}
</script>

<template>
    <div class="container">
        <div v-if="this.cartCounter() > 0">
            <div v-if="error">
                <h1>Si è verificato un errore</h1>
            </div>
            <div v-else>
                <h1>checkout</h1>
                <h2>{{ this.store.restaurants[getStorageValue('restaurant_id') - 1]?.name }}</h2>

                <div>
                    <div v-for="prodotto in this.store.products">
                        <!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
                        <div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">

                            <!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
                            <span>{{ prodotto.name }} -> <span class="counter" :data-id="prodotto.id"
                                    :data-name="prodotto.name" :id="prodotto.id + 'span'">{{
            this.getStorageValue(prodotto.id) ?? 0 }}</span></span>
                            <button class="btn btn-primary add" @click="this.cartAddElement(prodotto)">+</button>
                            <button class="btn btn-danger remove"
                                @click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">-</button>
                            <a href="#" @click="fullCartRemoveElement(prodotto)">rimuovi</a>

                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-4" @click="createBraintree()"> Seleziona il tuo metodo di
                    pagamento
                </button>
                <!-- BRAINTREE  -->
                <div id="dropin-container"></div>
                <button id="submit-button" class="button button--small button--green d-none">Conferma Selezione</button>
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
</style>