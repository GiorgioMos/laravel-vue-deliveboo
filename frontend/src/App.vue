<script>
import axios from 'axios'; //importo Axios
import { store } from "./store.js" //state management
import AppNavbar from "./components/AppNavbar.vue";
import AppHomePage from './pages/AppHomePage.vue';

export default {
	components: {
		AppNavbar,
		AppHomePage,
		
	},
	data() {
		return {
			store
		}
	},
	mounted() {
		this.doThings();

		// axios.get("indirizzo").then(risultato => {
		// 	console.log(risultato);
		// }).catch(errore => {
		// 	console.error(errore);
		// });
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
main {
	padding: 1rem;
}
</style>