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

	},
	methods: {
		getImage(img) {
			let image;
			if (img.startsWith("http")) {
				image = img;
			} else {
				image = asset("storage/" + img);
			}

			return new URL(image, import.meta.url).href;
		},
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
					<a class="btnNavbar rounded-pill px-4" href="#" id="shopping-cart" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
						<font-awesome-icon icon="fa-solid fa-cart-shopping" />
						<span class="text-white ms-2">{{ cartCounter() }} </span>
					</a>
				</li>

			</ul>
		</div>
	</nav>

	<!------------------------------------------------ OFFCANVAS ---------------------------------------->
	<!-- AUMENTARE DI DIMENSIONE E ABBELLIRE  -->

	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
		<div class="offcanvas-header">
			<h3 class="offcanvas-title fw-bold" id="offcanvasExampleLabel">Carrello - {{ cartCounter() }}
				prodotti</h3>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div id="offcanvas-body">

				<!-- ciclo su tutti i prodotti con un v-for -->
				<div v-for="prodotto in this.store.products">
					<!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
					<div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">

						<!-- DA STILICAZZOZARE -->
						<!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
						<div class="row">
							<div class="col-6 fw-bold mb-4">
								{{ prodotto.name }}
							</div>
							<div class="col-6 fw-bold">{{ Math.round(((prodotto.price * this.getStorageValue(prodotto.id))
								+ Number.EPSILON) * 100) / 100 }} </div>
						</div>

						<!-- Immagini, Counter e button aggiungi e rimuovi prodotto -->
						<img class="imgCart" :src="getImage(prodotto?.img)" alt="">

						<button class="btn btn-secondary add ms-4 rounded-pill"
							@click="this.cartAddElement(prodotto)">+</button>

						<span class="counter m-3" :data-id="prodotto.id" :data-name="prodotto.name"
							:id="prodotto.id + 'span'">
							{{ this.getStorageValue(prodotto.id) ?? 0 }}</span>

						<button class="btn btn-secondary remove rounded-pill"
							@click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">-</button>
						<p href="" @click="fullCartRemoveElement(prodotto)">rimuovi</p>


					</div>
				</div>

				<!-- costo totale prodotti nel carrello  -->
				<h5>TOTALE {{ this.cartTotal() }} €</h5>
			</div>

			<!-- bottone svuota carrello  -->
			<button data-bs-dismiss="offcanvas" :class="(cartCounter() > 0) ? 'd-inline-block' : 'd-none'" id="clearCart"
				class="btn btn-primary" @click="this.clearCart(); this.ArrayCart()"> Svuota
				carrello</button>

			<!-- bottone checkout  -->
			<router-link :to="{ name: 'checkout' }">
				<button data-bs-dismiss="offcanvas" v-if="cartCounter() > 0" id="order" class="btn btn-primary"> Procedi
					all'ordine</button>
			</router-link>
		</div>
	</div>
</template>

<style scoped>
.logoDeliveboo {
	width: 8rem;
}

a {
	text-decoration: none;
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


#offcanvasExample {
	width: 45rem !important;
	background-color: #242322e5;
}

#offcanvasExample>* {
	color: white !important;
}

/* Navbar */

.imgCart {
	width: 12rem;
	border-radius: 15px;
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
</style>
