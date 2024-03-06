<script>
import RestaurantList from "../components/RestaurantList.vue";
import JumboSwiper from "../components/JumboSwiper.vue";
import { store } from "../store.js" //state management



export default {
	name: "AppHomePage",
    components: {
        RestaurantList,
		JumboSwiper,
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
	<JumboSwiper />

	<div class="container">
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

</style>