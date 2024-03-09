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

				<!-- bottone carrello offcanvas -->
				<li class="nav-item">
					<a class="btn rounded-pill btn-outline-light px-4" href="#" id="shopping-cart"
						data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
						<font-awesome-icon icon="fa-solid fa-cart-shopping" />
						<span class="text-white">{{ cartCounter() }} </span>

					</a>


				</li>
				<li class="nav-item">
					<a class="btn btn-outline-light rounded-pill px-4 mx-3"
						href="http://localhost:8000/login">Accedi</a>
				</li>
				<li class="nav-item">
					<a class="btn rounded-pill bg-warning px-4" href="http://localhost:8000/register">Registrati</a>
				</li>
			</ul>
		</div>
	</nav>

	<!------------------------------------------------ OFFCANVAS ---------------------------------------->
	<!-- AUMENTARE DI DIMENSIONE E ABBELLIRE  -->

	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Carrello: hai selezionato {{ cartCounter() }}
				prodotti</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div id="offcanvas-body">

				<!-- costo totale prodotti nel carrello  -->
				<h5>TOTALE= {{ this.cartTotal() }}€</h5>


				<!-- ciclo su tutti i prodotti con un v-for -->
				<div v-for="prodotto in this.store.products">
					<!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
					<div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">

						<!-- DA STILICAZZOZARE -->
						<!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
						<span>{{ prodotto.name }} ({{ prodotto.price }}) ->
							<span class="counter" :data-id="prodotto.id" :data-name="prodotto.name"
								:id="prodotto.id + 'span'">
								{{ this.getStorageValue(prodotto.id) ?? 0 }}</span>
						</span>

						<button class="btn btn-primary add" @click="this.cartAddElement(prodotto)">+</button>

						<button class="btn btn-danger remove"
							@click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">-</button>
						<p href="#" @click="fullCartRemoveElement(prodotto)">rimuovi</p>

					</div>
				</div>
			</div>

			<!-- bottone svuota carrello  -->
			<button data-bs-dismiss="offcanvas" :class="(cartCounter() > 0) ? 'd-inline-block' : 'd-none'"
				id="clearCart" class="btn btn-primary" @click="this.clearCart(); this.ArrayCart()"> Svuota
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

.page-navigation {
	color: white;
	text-decoration: none;
	margin: 0 2rem;
}

.page-navigation:hover {
	text-decoration: underline;
	color: yellow;
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
</style>
