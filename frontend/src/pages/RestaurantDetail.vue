<script>
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios
import  functions  from '../functions.js'



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

		document.getElementById("clearCart").addEventListener("click", ()=>
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
					image = asset('storage/'+ img)
				}
				
				return new URL(image, import.meta.url).href
			}
        },
		aggiornaCounter() {
			let spans = document.querySelectorAll('.counter');

			if (localStorage.length!=0) {
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
		cartAddElement(product_id, product_name) {
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

		},

		//funzione che rimuove elementi alla lista dei prodotti selezionati
		cartRemoveElement(product_id, product_name) {
	let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
	// controllo che la quantità sia maggiore di 0, e in caso decremento, altrimenti setto il valore a 0 
	if (quantity > 0) {
		quantity--
	} else {
		quantity = 0
	}
	console.log(quantity);
	localStorage.setItem(product_name, quantity)
	document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity

	this.riempiCarrello(product_name);
		},
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
					<h1>Restaurant Name: {{ restaurant?.name }}</h1>
					<div class="imgBox rounded">
                    	<img class="cardImg rounded" :src="getImage(restaurant?.img)" alt="">
                	</div>
					<p>PRODOTTI:</p>
					<ul>
						<li v-for="product in restaurant?.products" class="product" :id="'product-'+product.id">
                            
                            <span class="counter" :data-id="product.id" :data-name="product.name"
                                :id="product.id+'span'">
                                0
                            </span>
							<button class="btn btn-primary add"
                                @click="cartAddElement(product?.id, product?.name);hideMinButton(product?.id)">+</button>
                            <button class="btn btn-danger remove"
                                @click="cartRemoveElement(product?.id, product?.name); hideMinButton( product?.id)">-</button>
                            {{ product?.name }}
                        </li>
					</ul>
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
.cardImg {
    max-width: 100%;
    min-height: 100%;
    object-fit: cover;
}

.imgBox {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    height: 20rem;
}
</style>