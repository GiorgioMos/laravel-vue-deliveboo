<script>
import RestaurantList from "../components/RestaurantList.vue";
import JumboSwiper from "../components/JumboSwiper.vue";
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios



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
		this.getCategories();
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
        }
	}
}
</script>

<template>
	<JumboSwiper />

	<div class="container">
		<!-- categories checkbox -->
		<div class="d-flex justify-content-center gap-2">
				<div v-for="category in store.categories" class="btn-group mb-3 category-btn" data-category-id="{{ category.id }}" role="group"
					aria-label="Basic checkbox toggle button group">
					<input hidden type="checkbox" name="categories[]" id="category{{ category.id }}"
						value="{{ category.id }}" autocomplete="off">
					<label class="btn btn-outline-primary form-label rounded" for="category{{ category.id }}">
						{{ category.name }}
					</label>
				</div>
		</div>

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