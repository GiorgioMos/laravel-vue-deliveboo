<script>
import RestaurantList from "../components/RestaurantList.vue";
import JumboSwiper from "../components/JumboSwiper.vue";
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import functions from '../functions.js'



export default {
	name: "AppHomePage",
	components: {
		RestaurantList,
		JumboSwiper,

	},
	created() {
		this.ArrayCart = functions.ArrayCart // recupera funzione in gunction.js
		this.clearCart = functions.clearCart // recupera funzione in gunction.js

	},
	data() {
		return {
			store,
			categoriesSelected: [],
			restaurants: [],
			visibleRestaurants: []
		}
	},
	beforeMount() {
		this.getCategories();
	},
	mounted() {
		this.ArrayCart(this.store.ArrayIdsInCart);

	},
	methods: {
		getCategories() {
			let url = this.store.apiRestaurants + this.store.categoriesEndPoint;

			axios.get(url).then(risultato => {
				// if di controllo
				if (risultato.status === 200) {
					if (risultato.data.success) {
						this.store.categories = risultato.data.payload;
					} else {
						// controllare statusCode, presenza e veridicità di data.success
						console.error("qualcosa è andato storto...");
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
			});
		},
		// funzione search 
		search(id_categoria) {

			//seleziono tutti i ristoranti
			this.restaurants = document.querySelectorAll(".card");


			// controllo se una categoria è presente nell'array delle categorie selezionate e in caso lo pusho o lo rimuovo 
			if (this.categoriesSelected.includes(id_categoria)) {
				var index = this.categoriesSelected.indexOf(id_categoria);
				this.categoriesSelected.splice(index, 1);
			} else {
				this.categoriesSelected.push(id_categoria);
			}

			this.restaurants.forEach(restaurant => {
				var metaCategories = restaurant.getAttribute('meta-categories').split(',');
				var showRestaurant = true; // Assumiamo inizialmente che l'elemento debba essere mostrato

				this.categoriesSelected.forEach(cat => {
					if (!metaCategories.includes(cat.toString())) {
						// Se una delle categorie selezionate non è presente nell'array di categorie dell'elemento, non mostriamo l'elemento
						showRestaurant = false;
					}
				});

				if (showRestaurant) {
					restaurant.classList.remove("d-none");
				} else {
					restaurant.classList.add("d-none");
				}
			});
		}
	}
}
</script>

<template>
	<JumboSwiper />

	<div class="container">

		<!-- categories checkbox -->
		<div class="d-flex justify-content-center gap-2">
			<div v-for="category in store.categories" class="btn-group mb-3 category-btn"
				:data-category-id="category.id" role="group" aria-label="Basic checkbox toggle button group">
				<input @click="search(category.id)" hidden type="checkbox" name="categories[]"
					:id="'category' + category.id" :value="category.id" autocomplete="off">
				<label class="btn btn-outline-primary form-label rounded" :for="'category' + category.id">
					{{ category.name }}
				</label>
			</div>
		</div>

		<!-- componente che fa lo show dei ristoranti -->
		<RestaurantList />
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
input[type="checkbox"]:checked+label {
	background-color: #007bff;
	color: #fff;
}
</style>