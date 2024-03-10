<script>
import functions from "../functions.js";
import { store } from "../store.js"; //state management

export default {
	name: "AppNavbar",

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
	methods: {
	},
	data() {
		return {
			store,

			menuItems: [
				{
					name: "registrazione",
					label: "Registrati",
				},
				{
					name: "login",
					label: "Accedi",
				},
				{
					routeName: "home",
					label: "About Us",
				},

			],
		};
	},
};
</script>
<!-- scrivere manualmente link e componenti singoli della navbar -->

<!-- logo a sinistra pagine al centro che riportano ai componenti e a destra carrello lohgin e registrazione -->
<template>
	<nav class="navbar navbar-expand-lg">
		<div class="container">

			<router-link :to="{ name: 'home' }">
				<div class="navbar-brand text-light">
					<img class="logoDeliveboo" src="/img/logoDeliveboo.png" alt="logoDeliveboo" />
				</div>
			</router-link>

			<ul class="navbar-nav">
				<li class="nav-item">
					<p class="page-navigation" href="#">Ristoranti</p>
				</li>
				<li class="nav-item">
					<router-link :to="{ name: 'about' }">
						<p class="page-navigation" href="/about">Chi Siamo</p>
					</router-link>
				</li>
				<li class="nav-item">
					<a class="page-navigation" href="#">Prodotti</a>
				</li>
			</ul>

			<ul class="navbar-nav">

				<!-- bottone accedi area riservata -->
				<li class="nav-item">
					<a class="btnNavbar rounded-pill px-4 mx-3" href="http://localhost:8000/admin">Area
						Riservata</a>
				</li>

				<!-- bottone carrello offcanvas -->
				<li class="nav-item">
					<a  class="btnNavbar rounded-pill px-4" href="#" id="shopping-cart" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
						<font-awesome-icon icon="fa-solid fa-cart-shopping" />
						<span v-if="this.cartTotal() != 0 " class="text-white ms-2">{{ cartCounter() }} </span>
					</a>
				</li>

			</ul>
		</div>
	</nav>

	<!------------------------------------------------ OFFCANVAS ---------------------------------------->

	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title fw-bold cartName mt-3" id="offcanvasExampleLabel">Carrello
            <!--  - {{ cartCounter() }} -->
        </h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <div id="offcanvas-body" class="d-flex flex-column justify-content-around h-100">
            <!-- ciclo su tutti i prodotti con un v-for -->
            <div v-for="prodotto in this.store.products">
                <!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
                <div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">
                    <!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
                    <div class="row">
                        <!-- Immagine singolo prodotto -->
                        <div class="col-4">
                            <div class="boxImg">
                                <img class="imgCart mb-5" :src="this.getImage(prodotto?.img)" alt="">
                            </div>
                        </div>
                        <!-- Nome, prezzo e button rimuovi singolo prodotto -->
                        <div class="col-5">
                            <router-link :to="{ name: 'restaurant-detail', params: { id: prodotto?.restaurant_id } }">
                                <span class="col-6 fs-4 mb-4 cart-title">
                                    {{ prodotto.name }}
                                </span>
                            </router-link>
                            <div class="col-6 fw-bold mt-2 mb-5"> € {{ Math.round(((prodotto.price * this.getStorageValue(prodotto.id)) + Number.EPSILON) * 100) / 100 }}
                            </div>
                            <!-- Rimuove tutti i prodotti nel carrello -->
                            <p class="btn btn-dark text-danger rounded-pill" @click="fullCartRemoveElement(prodotto)">Rimuovi</p>
                        </div>
                        <!-- Button aggiungi e rimuovi prodotto -->
                        <div class="col-3">
                            <!-- Rimuove prodotto -->
                            <span class="remove">
                                <span class="circle-icon btn"
                                    @click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">
                                    <font-awesome-icon icon="fa-solid fa-minus" />
                                </span>
                            </span>
                            <!-- Numero totale prodotti -->
                            <span class="counter m-4 fw-bold" :data-id="prodotto.id" :data-name="prodotto.name"
                            :id="prodotto.id + 'span'">
                            {{ this.getStorageValue(prodotto.id) ?? 0 }}</span>
                            <!-- Aggiunge prodotto -->
                            <span class="add">
                                <span class="circle-icon btn" @click="this.cartAddElement(prodotto)">
                                    <font-awesome-icon icon="fa-solid fa-plus" />
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Costo totale prodotti nel carrello  -->
            <div v-if="this.cartTotal() != 0 " class="row mt-auto">
                <hr>
                <div class="col-9">
                    <h6 class="fs-5 fw-bold"> Totale </h6>
                </div>
                <div class="col-3">
                    <div class="fs-5 fw-bold fs-4 text-end">
                        € {{ this.cartTotal() }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8">
                        <!-- Button svuota carrello  -->
                        <button data-bs-dismiss="offcanvas" :class="(cartCounter() > 0) ? 'd-inline-block' : 'd-none'" id="clearCart" class="btnCart rounded-pill" @click="this.clearCart(); this.ArrayCart()"> Svuota carrello</button>
                    </div>
                    <div class="col-4 text-end">
                        <!-- Button checkout  -->
                        <router-link :to="{ name: 'checkout' }">
                            <button data-bs-dismiss="offcanvas" v-if="cartCounter() > 0" id="order" class="btnCart btnYellow rounded-pill">Procedi all'ordine</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<style scoped>
/* NAVBAR */
.logoDeliveboo {
	width: 8rem;
}

a {
	text-decoration: none;
}


.btnNavbar {
	color: white;
	background-color: #066e7c;
	padding: 10px;
	border: 2px solid #f9b44b;
	font-weight: bold;
}

.btnNavbar:hover {
	background-color: #f9b44b;
	color: black;
}

.page-navigation {
	text-decoration: none !important;
	color: white;
	text-decoration: none;
	margin: 0 3rem;
	font-weight: bold;
}

.page-navigation:hover {
	text-decoration: underline;
	color: #066e7c;
}

font-awesome-icon {
	color: yellow;
}

font-awesome-icon:hover {
	color: white;
}

/* CARRELLO OFFCANVAS */

#offcanvasExample {
	width: 45rem !important;
	/* background-color: #242322e5; */
	background-color: rgb(35, 35, 35);
}

#offcanvasExample>* {
	color: white !important;
}

/* titolo */
.cart-title {
	color: whitesmoke;
	font-weight: 600;
}

.cart-title:hover {
	color: #066e7c;
	transition: 300ms;
}


/* immagini e box */
.boxImg {
	width: 12rem;
	height: 8rem;
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
	background-color: #f9b44b;
	color: black;
	font-size: 16px;
	cursor: pointer;
	transition: transform 0.2s;
}

.circle-icon:hover {
	background-color: #f9b44b;
	color: black;
	transform: scale(1.2);
}

.cartName {
	color: #f9b44b;
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
	background-color: #f9b44b;
	color: black;
}
</style>
