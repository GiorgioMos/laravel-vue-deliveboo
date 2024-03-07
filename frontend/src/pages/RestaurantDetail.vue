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
		},
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
			<div v-else class="row py-3 text-warning">
				<h1>Restaurant Name: {{ restaurant?.name }}</h1>
				<div class="imgBox rounded">
					<img class="cardImg rounded" :src="getImage(restaurant?.img)" alt="">
				</div>
				<p>PRODOTTI:</p>
				<ul>
					<li v-for="product in restaurant?.products" class="product" :id="'product-' + product.id">

						<span class="counter" :data-id="product.id" :data-name="product.name"
							:id="product.id + 'span'">0</span>
						<button class="btn btn-primary add"
							@click="cartAddElement(product); hideMinButton(product?.id)">+</button>
						<button class="btn btn-danger remove"
							@click="cartRemoveElement(product); hideMinButton(product?.id)">-</button>
						{{ product?.name }}
						<a class="remove" href="#" @click="fullCartRemoveElement(product)">rimuovi</a>

						<!-- v-if="parseInt(document.querySelector(`span[data-id='${product.id}']`).innerHTML) == 0" -->
					</li>
				</ul>
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
				<button type="button" class="btn btn-secondary" @click="this.clearCart(); this.ArrayCart()" data-bs-dismiss="modal">Svuota carrello</button>
				<a :href="'http://localhost:5000/restaurants/' + getStorageValue('restaurant_id')" class="btn btn-primary">Ristorante in corso</a>
				
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
.cardImg {
	max-width: 100%;
	min-height: 100%;
	object-fit: cover;
}

.imgBox {
	display: flex;
	justify-content: center;
	align-items: center;
	overflow: hidden;
	height: 20rem;
}
</style>