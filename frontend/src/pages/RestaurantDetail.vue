<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import functions from '../functions.js'
import * as bootstrap from "bootstrap";



export default {
	name: "RestaurantDetail",
	props: ["id"],
	data() {
		return {
			store,
			restaurant: null,
			error: false,
		}
	},
	created() {
		this.aggiornaCounter = functions.aggiornaCounter
		this.ArrayCart = functions.ArrayCart
		this.hideMinButton = functions.hideMinButton
		this.cartAddElement = functions.cartAddElement
		this.cartRemoveElement = functions.cartRemoveElement
		this.fullCartRemoveElement = functions.fullCartRemoveElement
		this.clearCart = functions.clearCart
		this.getStorageValue = functions.getStorageValue
		this.currentValue = functions.currentValue


	},
	beforeMount() {
		this.getRestaurantDetail();
	},
	mounted() {
	},
	updated() {
		this.aggiornaCounter();

		document.getElementById("clearCart").addEventListener("click", () =>
			this.aggiornaCounter()
		)

	},
	methods: {
		getRestaurantDetail() {
			let url = this.store.apiRestaurants + this.store.restaurantsEndPoint + this.id;

			axios.get(url).then(result => {
				if (result.status === 200) {
					if (result.data.success) {
						this.restaurant = result.data.payload;
					} else {
						console.error("Ops... non siamo in grado di soddisfare la richiesta.");
						this.error = true;
					}

				} else if (result.status === 301) {
					console.error("Ops... ciò che cerchi non si trova più qui.");
				} else if (result.status === 400) {
					console.error("Ops... non riusciamo a comprendere ciò che hai richiesto.");
				} else if (result.status === 404) {
					console.error("Ops... non riusciamo a trovare ciò che hai richiesto.");
				} else if (result.status === 500) {
					console.error("Ops... ci scusiamo per l'inconveniente, stiamo spegnendo l'incendio.");
				}
			}).catch(errore => {
				console.error(errore);
				this.$router.push({ name: "home" }); // redireziona alla lista eventi
			});
		},
		getImage(img) {

			if (img) {

				let image;
				if (img.startsWith('http')) {
					image = img;
				} else {
					image = asset('storage/' + img)
				}

				return new URL(image, import.meta.url).href
			}
		}
	}
}
</script>

<template>
	<div class="container">
		<div v-if="error">
			<h1>Si è verificato un errore</h1>
		</div>
		<div v-else>
			<div v-if="!restaurant" class="d-flex justify-content-center align-items-center">
				<h1>Loading..</h1>
			</div>

			<!-- SEZIONE JUMBO RISTORANTE -->
			<div id="spacer" v-else class="row py-3 text-warning">
				<div class="d-flex mt-4 mb-5">
					<div id="imgbox" class="imgBox rounded m-5 flex-column">
						<img class="cardImg rounded" :src="getImage(restaurant?.img)" alt="">
						<div id="restaurant-info">
							<h1 class="mb-4 fw-bold"> {{ restaurant?.name }} </h1>
							<p class="my-1">🏠 {{ restaurant?.address }} </p>
							<p class="my-1">🌇 {{ restaurant?.city }}</p>
							<p class="my-1">☎️ {{ restaurant?.telephone }}</p>
						</div>
					</div>
					<div id="restaurant-desc"
						class="d-flex flex-column m-3 align-items-start p-5 justify-content-center">
						<div class="my-4 mb-4 py-2 pt-5"> {{ restaurant?.description }} </div>
						<button id="button" class="btn mt-1"><a :href="restaurant?.website">Sito Web</a></button>
					</div>
				</div>

				<!-- SEZIONE PRODOTTI RISTORANTE -->
				<h2 class="my-3">I Nostri Piatti</h2>
				<div class="d-flex justify-content-center gap-4">
					<div v-for="product in restaurant?.products" class="product card-list my-5"
						:id="'product-' + product.id">
						<article class="cards">
							<figure class="card-image">
								<img id="product-img" :src="product?.img" alt="Immagine-ristorante">
							</figure>
							<div class="card-header d-flex flex-column">
								<h4>{{ product?.name }}</h4>
								<p>{{ product?.description }}</p>
								<p>Prezzo: {{ product?.price }} €</p>
							</div>
							<div class="card-footer">
								<button id="cart-remove" class="btn remove"
									@click="cartRemoveElement(product); hideMinButton(product?.id)">-</button>
								<span class="counter mx-4" :data-id="product.id" :data-name="product.name"
									:id="product.id + 'span'"> {{ this.currentValue(product) }} </span>
								<button id="cart-add" class="btn add"
									@click="cartAddElement(product); hideMinButton(product?.id)">+</button>
								<a class="remove" href="#" @click="fullCartRemoveElement(product)">rimuovi</a>
							</div>
						</article>
					</div>
				</div>
				<!-- BOTTONE GO BACK TO HOMEPAGE -->
				<div class="row d-flex justify-content-end">
					<div class="col-2 py-3">
						<router-link :to="{ name: 'home' }" class="btn btn-info">
							<span>Go Back</span>
						</router-link>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-dark">
					Stai già ordinando da un'altro ristorante
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" @click="this.clearCart(); this.ArrayCart()"
						data-bs-dismiss="modal">Svuota carrello</button>
					<a :href="'http://localhost:5000/restaurants/' + getStorageValue('restaurant_id')"
						class="btn btn-primary">Ristorante in corso</a>

				</div>
			</div>
		</div>
	</div>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use '../styles/general.scss';
</style>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue

h2 {
	text-align: center;
}

button>a {
	text-decoration: none;
	color: white;
}

#spacer {
	margin-top: 3rem;
}

#button {
	background-color: #060113;
	border: solid 2px #066E7C;
	border-radius: 20px;
	padding: 10px 20px;
	transition: .15s ease-in;
	margin: 0 30%;
}

#button:hover {
	background-color: #066E7C;
}

.cardImg {
	max-width: 100%;
	min-height: 100%;
	object-fit: cover;
	border-radius: 30px !important;
	position: relative;
}

#product-img {
	width: 22rem;
	height: 18rem;
	object-fit: cover;
	border-radius: 5px;
}

.imgBox {
	display: flex;
	justify-content: center;
	align-items: center;
	overflow: hidden;
	height: 40rem;
	width: 150rem;
}

li {
	list-style-type: none;
}

#restaurant-desc {
	font-size: 1.2rem;
	width: 60rem;
	line-height: 2.4rem;
	transition: transform 0.2s;
	border-radius: 20px;
}

#restaurant-desc:hover {
	transform: scale(1.02);
}

//OCIO QUI CHE LE QUANDO SI FA IL SITO RESPONSIVE PARTONO LE MADONNE

#restaurant-info {
	position: absolute;
	transition: transform 0.2s;
	background-color: #3d3737;
	padding: 1rem;
	width: 35rem;
	height: 16rem;
	border-radius: 15px;
	bottom: 500px;
	left: 940px;
	opacity: 0.85;
}

#restaurant-info:hover {
	transform: scale(1.02);
}

//css product card

img {
	max-width: 100%;
	display: block;
}

.card-list {
	width: 90%;
	max-width: 400px;
}

.cards {
	background-color: #3d3737;
	box-shadow: 0 0 0 1px rgba(#000, .05), 0 20px 50px 0 rgba(#000, .1);
	border-radius: 15px;
	overflow: hidden;
	padding: 1.25rem;
	position: relative;
	transition: .15s ease-in;

	&:hover,
	&:focus-within {
		box-shadow: 0 0 0 2px #066E7C, 0 10px 60px 0 rgba(#000, .1);
		transform: translatey(-5px);
	}
}

.card-image {
	border-radius: 10px;
	overflow: hidden;
}

.card-header {
	margin-top: 1.5rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
}

.card-footer {
	margin-top: 1.25rem;
	border-top: 1px solid #ddd;
	padding-top: 1.25rem;
	display: flex;
	align-items: center;
	justify-content: center;
}

//css bottoni prodotti

#cart-remove {

	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #066E7C;
	height: 2rem;
	width: 2rem;
	border-radius: 50%;
	color: #F59754;
	text-align: center;
	line-height: 1rem;
	border: 1px solid #F59754;
	transition: background-color 0.3s ease;
	transition: border 0.3s ease;
	transition: transform 0.2s;
}

#cart-remove:hover {
	background-color: #060113;
	border: 1px solid #066E7C;
	transform: scale(1.2);
}

#cart-add {
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #066E7C;
	height: 2rem;
	width: 2rem;
	border-radius: 50%;
	color: #F59754;
	text-align: center;
	line-height: 1rem;
	border: 1px solid #F59754;
	transition: background-color 0.3s ease;
	transition: border 0.3s ease;
	transition: transform 0.2s;
}

#cart-add:hover {
	background-color: #060113;
	border: 1px solid #066E7C;
	transform: scale(1.2);
}
</style>