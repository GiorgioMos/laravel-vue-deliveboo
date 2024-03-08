<script>
import functions from '../functions.js'
import { store } from "../store.js" //state management

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


	},
	methods: {
		cartCounter() {
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
		}
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

				/* 		{
				  routeName: "aboutUs",
				  label: "About Us"
				},
				{
				  routeName: "login",
				  label: "Login"
				},
				{
				  routeName: "register",
				  label: "Register"
				},
		 */
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
			<a class="navbar-brand text-light" href="/">
				<img class="logoDeliveboo" src="public/img/logoDeliveboo.png" alt="logoDeliveboo">
			</a>

			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="page-navigation" href="#">Ristoranti</a>
				</li>
				<li class="nav-item">
					<a class="page-navigation" href="/about">Chi Siamo</a>
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

	<!--   <nav class="navbar border-body">
						  <div class="container">
							<a class="navbar-brand text-light" href=".">Logo</a>
						  </div>
						  <div>
							<a href="" class="navbar-text">sdfg</a>
							<a href="" class="nav-link">asdf</a>
							<a href="" class="nav-link">asdf</a>
						  </div>
						</nav> -->

	<!-- <div class="col-3 text-start">
					  						<a href=".">
					  							<link rel="stylesheet" href="/public/router.png">
					  							<img src="/public/router.png" alt="">
					  						</a>
					  					</div> -->
	<!-- <div v-for="(item, index) in menuItems" :key="index" class="col-2 d-flex justify-content-center align-items-center">
					  						<router-link :to="{name: item.routeName}" class="nav-link">
					  							<h3>{{ item.label }}</h3>
					  						</router-link>
					  					</div> -->

	<!-- OFFCANVAS -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Carrello</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div id="offcanvas-body">


				<!-- ciclo su tutti i prodotti con un v-for -->
				<div v-for="prodotto in this.store.products">
					<!-- controllo se l'id del prodotto corrisponde ad un id in localStorage e lo creo -->
					<div v-if="this.store.ArrayIdsInCart.includes(prodotto.id.toString())">

						<!-- stampo i dati del prodotto e la quantità attraverso la funzione magica per richiamare i dati del localstorage -->
						<span>{{ prodotto.name }} -> {{ this.getStorageValue(prodotto.id) }}</span>
						<button class="btn btn-primary add"
							@click="cartAddElement(prodotto); hideMinButton(prodotto.id)">+</button>
						<button class="btn btn-danger remove"
							@click="cartRemoveElement(prodotto); hideMinButton(prodotto.id)">-</button>
						<a href="#" @click="fullCartRemoveElement(prodotto)">rimuovi</a>

					</div>
				</div>



				<!-- <div v-for="id in this.store.ArrayIdsInCart" :key="id">
		  <div v-if="!isNaN(id)">
			{{ id }} -> {{ getStorageValue(id) }}
		  </div>
		</div> -->
			</div>
			<button id="clearCart" class="btn btn-primary" @click="this.clearCart(); this.ArrayCart()"> Svuota
				carrello</button>
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
</style>
