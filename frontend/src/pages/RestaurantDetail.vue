<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios



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
	mounted() {
		// this.restaurant = this.store.eventList.find(item => item.id == this.id);
		this.getRestaurantDetail();
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
				this.$router.push({ name: "restaurants" }); // redireziona alla lista eventi
            });
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
				<div class="row py-3 text-warning">
					<h1>Event Name: {{ restaurant?.name }}</h1>
					
                    <div class="row d-flex justify-content-end">
						<div class="col-2 py-3">
							<router-link :to="{ name: 'restaurants' }" class="btn btn-info">
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

</style>