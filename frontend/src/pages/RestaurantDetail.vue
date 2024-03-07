<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import functions from '../functions.js'



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
		this.riempiCarrello = functions.riempiCarrello // recupera funzione in function.js

	},
	beforeMount() {
		this.getRestaurantDetail();
	},
	mounted() {

	},
	updated() {
		this.aggiornaCounter();
		this.riempiCarrello();

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
		aggiornaCounter() {
			let spans = document.querySelectorAll('.counter');

			if (localStorage.length != 0) {
				spans.forEach(element => {
					//ciclo sugli elementi nel local storage
					for (let i = 0; i < localStorage.length; i++) {
						// seleziono la key 
						let key = localStorage.key(i);
						// recupero il nome del prodotto 
						let nome = element.getAttribute('data-name');
						// salvo il valore corrispondente che si trova nel local storage in una variabile 
						let value = localStorage.getItem(key);
						// se il nome prodotto dello span è uguale a quello nel local storage gli sparo dentro il valore corrispondente 
						if (nome == key) {
							document.querySelector(`span[data-name="${nome}"]`).innerHTML = value
						}

					}

					// recupero l'id 
					let id = element.getAttribute('data-id');
					// richiamo la funzione per nascondere il tasto meno, e gli passo l'id 
					this.hideMinButton(id)
				});
			} else {
				spans.forEach(element => {
					element.innerHTML = 0
					// recupero l'id 
					let id = element.getAttribute('data-id');
					// richiamo la funzione per nascondere il tasto meno, e gli passo l'id 
					this.hideMinButton(id)
				})
			}
		},

		// nascondo il bottone se il valore è 0 
		hideMinButton(id) {
			var valore = document.getElementById(`${id}span`).innerHTML
			// seleziono il bottone - 
			const min = document.getElementById(`product-${id}`).getElementsByClassName("remove")[0]
			if (valore == 0) {
				min.classList.add(
					"d-none")
			} else {
				if (min.classList.contains("d-none")) {

					min.classList.remove("d-none")
				}
			}
		},
		//funzione che aggiunge elementi alla lista dei prodotti selezionati
		cartAddElement(restaurant_id, product_name) {

			// controllo se il ristorante corrente è vuoto o se è uguale a quello del prodotto che voglio inserire 
			if (localStorage.getItem("restaurant_id") == null || restaurant_id == localStorage.getItem("restaurant_id")) {
				localStorage.setItem("restaurant_id", restaurant_id)

				// recupero il valore della quantità
				let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
				//incremento la quantitù
				quantity++
				// salvo la coppia nome-quantità nel local storage 
				localStorage.setItem(product_name, quantity)
				// la sparo in pagina nello span relativo a quel prodotto
				document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity
				// richiamo la funzione che mi aggiorna i prodotti nel carrello 
				this.riempiCarrello(product_name);
			} else {

				// todo inserire alert o modal
				console.log("non si fa");
			}

		},

		//funzione che rimuove elementi alla lista dei prodotti selezionati
		cartRemoveElement(product_id, product_name) {
			let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
			let productAllZero = 0;
			// controllo che la quantità sia maggiore di 0, e in caso decremento, altrimenti setto il valore a 0 
			if (quantity > 0) {
				quantity--

				if (quantity != 0) {
					localStorage.setItem(product_name, quantity)

				} else {
					localStorage.removeItem(product_name)

				}
				document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity

				this.riempiCarrello(product_name);

				//se l'unico elemento del localstorage è il restaurant id allora lo rimuovo
				if (localStorage.length == 1) {
					localStorage.removeItem("restaurant_id")
				}
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
			<div v-else class="row py-3 text-warning">
				<div class="d-flex mt-4 mb-5">
					<div class="d-flex flex-column m-3 align-items-start p-2 justify-content-center">
						<h1 class="mb-5"> {{ restaurant?.name }} </h1> 
						<div class="my-4"> {{ restaurant?.description }} </div>
						<div class="my-3"> {{ restaurant?.address }} </div>
						<button id="button" class="btn mt-5" ><a :href="restaurant?.website">Sito Web</a></button>
					</div>
					<div  class="imgBox rounded m-5">
						<img class="cardImg rounded" :src="getImage(restaurant?.img)" alt="">
					</div>
				</div>
				<h2 class="my-3">I Nostri Piatti</h2>
					<div v-for="product in restaurant?.products" class="product card-list my-5" :id="'product-' + product.id">
						<article class="cards">
							<figure class="card-image">
								<img id="product-img" :src="product?.img" alt="Immagine-ristorante">
							</figure>
							<div class="card-header d-flex flex-column">
								<h4>{{ product?.name }}</h4>
								<p>{{ product?.description }}</p>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary add" @click="cartAddElement(product?.restaurant_id, product?.name); hideMinButton(product?.id)">+</button>
								<span class="counter" :data-id="product.id" :data-name="product.name" :id="product.id + 'span'">0</span>
								<button class="btn btn-danger remove" @click="cartRemoveElement(product?.restaurant_id, product?.name); hideMinButton(product?.id)">-</button>
							</div>
						</article>
					</div>
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

</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use '../styles/general.scss';
</style>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue

h2{
	text-align: center;
}
button > a{
	text-decoration: none;
	color: white;
}

#button{
	text-decoration: none;
	color: white;
	background-color: #060113;
	border-radius: 20px;
	padding: 10px 20px;
}

.cardImg {
	max-width: 100%;
	min-height: 100%;
	object-fit: cover;
	border-radius: 30px !important;
}

#product-img{
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
	height: 35rem;
	width: 55rem;
}

li{
	list-style-type: none;
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
	
	&:hover, &:focus-within {
		box-shadow: 0 0 0 2px #16C79A, 0 10px 60px 0 rgba(#000, .1);
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
	flex-wrap: wrap;
}
</style>