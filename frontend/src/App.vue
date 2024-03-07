<script>
import axios from 'axios'; //importo Axios
import { store } from "./store.js" //state management
import AppNavbar from "./components/AppNavbar.vue";
import AppHomePage from './pages/AppHomePage.vue';
import functions from './functions.js'


export default {
	components: {
		AppNavbar,
		AppHomePage,

	},
	created() {
	},
	data() {
		return {
			store
		}
	},
	mounted() {
		this.doThings();

		// aggiorno il carrello al caricamento dell'applicazione 
		this.ArrayCart()

		this.getProducts(); 
	},
	methods: {
		doThings() {
			console.log("App.vue does things");
		},
		ArrayCart: function () {
			this.store.ArrayIdsInCart = Object.keys(localStorage)
			console.log(this.store.ArrayIdsInCart)
		},
		// chiamata axios per i prodotti
		getProducts() {
			let url = this.store.apiRestaurants + this.store.productsEndPoint;

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
	}
}
</script>

<template>
	<header>
		<AppNavbar />
	</header>

	<main>
		<router-view></router-view>
	</main>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use './styles/general.scss';
</style>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue</style>