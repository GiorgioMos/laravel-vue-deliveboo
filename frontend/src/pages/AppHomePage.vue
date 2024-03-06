<script>
import RestaurantCard from "../components/RestaurantCard.vue";
import { store } from "../store.js" //state management



export default {
	name: "AppHomePage",
    components: {
        
    },
	data() {
		return {
			store
		}
	},
	mounted() {
		
	},
	methods: {
		
	}
}
</script>

<template>
	<div class="container">
		<h1>GAY</h1>
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

</style>