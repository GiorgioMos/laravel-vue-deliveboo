<script>
import axios from 'axios'; //importo Axios
import { store } from "./store.js" //state management
import AppNavbar from "./components/AppNavbar.vue";
import AppHomePage from './pages/AppHomePage.vue';
import  functions  from './functions.js'


export default {
	components: {
		AppNavbar,
		AppHomePage,
		
	},
	created() { 
      this.riempiCarrello = functions.riempiCarrello // recupera funzione in gunction.js

    },
	data() {
		return {
			store
		}
	},
	mounted() {
		this.doThings();

		// aggiorno il carrello al caricamento dell'applicazione 
		this.riempiCarrello

	},
	methods: {
		doThings() {
			console.log("App.vue does things");
		}
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

// ...qui eventuale SCSS di App.vue

</style>