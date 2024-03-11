<script>
import { store } from "../store.js"; //state management
import axios from "axios"; //importo Axios
import functions from "../functions.js";
import * as bootstrap from "bootstrap";

export default {
	name: "RestaurantDetail",
	props: ["id"],
	data() {
		return {
			store,
			restaurant: null,
			error: false,
		};
	},
	created() {
		this.aggiornaCounter = functions.aggiornaCounter;
		this.ArrayCart = functions.ArrayCart;
		this.hideMinButton = functions.hideMinButton;
		this.cartAddElement = functions.cartAddElement;
		this.cartRemoveElement = functions.cartRemoveElement;
		this.fullCartRemoveElement = functions.fullCartRemoveElement;
		this.clearCart = functions.clearCart;
		this.getStorageValue = functions.getStorageValue;
		this.currentValue = functions.currentValue;
		this.getImage = functions.getImage;
	},
	beforeMount() {
		this.getRestaurantDetail();
	},
	mounted() {
		this.ArrayCart();
	},
	updated() {
		this.aggiornaCounter();

		if (document.getElementById("clearCart")) {
			document
				.getElementById("clearCart")
				.addEventListener("click", () => this.aggiornaCounter());
		}
	},
	methods: {
		getRestaurantDetail() {
			let url =
				this.store.apiRestaurants + this.store.restaurantsEndPoint + this.id;

			axios
				.get(url)
				.then((result) => {
					if (result.status === 200) {
						if (result.data.success) {
							this.restaurant = result.data.payload;
						} else {
							console.error(
								"Ops... non siamo in grado di soddisfare la richiesta."
							);
							this.error = true;
						}
					} else if (result.status === 301) {
						console.error("Ops... ciò che cerchi non si trova più qui.");
					} else if (result.status === 400) {
						console.error(
							"Ops... non riusciamo a comprendere ciò che hai richiesto."
						);
					} else if (result.status === 404) {
						console.error(
							"Ops... non riusciamo a trovare ciò che hai richiesto."
						);
					} else if (result.status === 500) {
						console.error(
							"Ops... ci scusiamo per l'inconveniente, stiamo spegnendo l'incendio."
						);
					}
				})
				.catch((errore) => {
					console.error(errore);
					this.$router.push({ name: "home" }); // redireziona alla lista eventi
				});
		},
	},
};
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
			<div id="spacer" v-else class="row py-3" style="color: #ff9900">
				<div class="d-flex mt-4 mb-5 position-relative">
					<div id="imgbox" class="imgBox rounded m-5 flex-column">
						<img class="cardImg rounded" :src="this.getImage(restaurant?.img)" alt="" />
						<div id="restaurant-info">
							<h1 class="mb-4 fw-bold">{{ restaurant?.name }}</h1>
							<p class="my-1 text-white fw-bold">
								<font-awesome-icon class="icon mx-3" icon="fa-solid fa-location" />
								{{ restaurant?.address }}
							</p>
							<p class="my-1 text-white fw-bold">
								<font-awesome-icon class="icon icon mx-3" icon="fa-solid fa-city" />
								{{ restaurant?.city }}
							</p>
							<p class="my-1 text-white fw-bold">
								<font-awesome-icon class="icon icon mx-3" icon="fa-solid fa-phone" />
								{{ restaurant?.telephone }}
							</p>
						</div>
					</div>
					<div id="restaurant-desc"
						class="text-center d-flex flex-column my-5 align-items-start py-5 justify-content-center">
						<div class="restaurantDescription">
							{{ restaurant?.description }}
						</div>
						<button id="button" class="btn rounded-pill my-3">
							<a :href="restaurant?.website" class="fs-6">Sito Web</a>
						</button>
					</div>
				</div>

				<!-- SEZIONE PRODOTTI RISTORANTE -->
				<div class="d-flex justify-content-center gap-4">
					<div v-if="restaurant?.products == 0">
						<h1>Questo ristorante al momento non ha prodotti disponibili</h1>
					</div>
					<div v-else>
						<h2 class="my-3 fw-bold" style="color: white">I Nostri Piatti</h2>
						<div class="d-flex row">
							<div class="col-4" v-for="product in restaurant?.products">
								<div v-if="product?.visible == 1" class="product card-list my-5"
									:id="'product-' + product.id">
									<article class="cards">
										<figure class="card-image">
											<img id="product-img" :src="this.getImage(product?.img)"
												alt="Immagine-ristorante" />
										</figure>
										<div class="card-header d-flex flex-column">
											<h4 class="fw-bold text-white">{{ product?.name }}</h4>
											<p class="cardDescription text-white text-center">
												{{ product?.description }}
											</p>
											<p>€ {{ product?.price }}</p>
										</div>
										<div class="card-footer">
											<button id="cart-remove" class="btn remove" @click="
			cartRemoveElement(product);
		hideMinButton(product?.id);
		">
												-
											</button>
											<span class="counter mx-4" :data-id="product.id" :data-name="product.name"
												:id="product.id + 'span'">
												{{ this.currentValue(product) }}
											</span>
											<button id="cart-add" class="btn add" @click="
			cartAddElement(product);
		hideMinButton(product?.id);
		">
												+
											</button>
											<!-- <a class="remove" href="#"
																																																																												@click="fullCartRemoveElement(product)">rimuovi</a> -->
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BOTTONE GO BACK TO HOMEPAGE -->
			<div class="row d-flex justify-content-end">
				<div class="col-2">
					<router-link :to="{ name: 'home' }" class="btn rounded-pill"
						style="background-color: #ff9900; border: solid 1px #ff9900">
						Torna indietro
					</router-link>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header d-flex justify-content-center">
						<h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Attenzione</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Stai già ordinando da un'altro ristorante
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" @click="
			this.clearCart();
		this.ArrayCart();
		" data-bs-dismiss="modal">
							Svuota carrello
						</button>
						<a :href="'http://localhost:5000/restaurants/' +
			getStorageValue('restaurant_id')
			" class="btn bgYellow">Ristorante in corso</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use "../styles/general.scss";
</style>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue
.modal-content {
	background-color: #060113 !important;
	border-color: #ff9900;
	color: white !important;
}

.modal-footer,
.modal-header {
	border: none;
}

.modal-footer .btn-danger:hover {
	background-color: #060113;
	border: solid 1px red;
}

.modal-footer .bgYellow:hover {
	background-color: #060113;
	border: solid 1px #ff9900;
}

.btn-close::after {
	color: white;
}

.modal-header button {
	color: white;
}

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
	border: solid 2px #ff9900;
	border-radius: 20px;
	padding: 0.5rem 1rem;
	transition: 0.15s ease-in;
	margin: 0 auto;
}

#button:hover {
	background-color: #ff9900;
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

.restaurantDescription {
	margin-top: 10rem;
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
	background-color: rgba($color: #060113, $alpha: 0.8);
	border: #ff9900 solid 1px;
	padding: 3rem;

	border-radius: 15px;
	bottom: 550px;
	left: 750px;
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
	background-color: #060113;
	box-shadow: 0 0 0 1px rgba(#000, 0.05), 0 20px 50px 0 rgba(#000, 0.1);
	border-radius: 15px;
	overflow: hidden;
	padding: 1.25rem;
	position: relative;
	transition: 0.15s ease-in;

	&:hover,
	&:focus-within {
		box-shadow: 0 0 0 1px #ff9900, 0 10px 60px 0 rgba(#000, 0.1);
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

#go-back-btn:hover {
	background-color: #ff9900;
	color: #000;
}

//css bottoni prodotti

#cart-remove {
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #060113;
	height: 2rem;
	width: 2rem;
	border-radius: 50%;
	color: #f59754;
	text-align: center;
	line-height: 1rem;
	border: 1px solid #f59754;
	transition: background-color 0.3s ease;
	transition: border 0.3s ease;
	transition: transform 0.2s;
}

#cart-remove:hover {
	background-color: #060113;
	border: 1px solid #ff9900;
	transform: scale(1.2);
}

#cart-add {
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #060113;
	height: 2rem;
	width: 2rem;
	border-radius: 50%;
	color: #f59754;
	text-align: center;
	line-height: 1rem;
	border: 1px solid #f59754;
	transition: background-color 0.3s ease;
	transition: border 0.3s ease;
	transition: transform 0.2s;
}

#cart-add:hover {
	background-color: #060113;
	border: 1px solid #ff9900;
	transform: scale(1.2);
}

.cardDescription {
	height: 100px;
	line-height: 2rem;
	margin-top: 20px;
}
</style>
