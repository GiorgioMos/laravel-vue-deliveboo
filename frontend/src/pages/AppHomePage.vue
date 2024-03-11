<script>
import RestaurantList from "../components/RestaurantList.vue";
import JumboSwiper from "../components/JumboSwiper.vue";
import RestaurantSwiper from "../components/RestaurantSwiper.vue";
import { store } from "../store.js"; //state management
import axios from "axios"; //importo Axios
import functions from "../functions.js";

export default {
  name: "AppHomePage",
  components: {
    RestaurantList,
    JumboSwiper,
    RestaurantSwiper,
  },
  created() {
    this.ArrayCart = functions.ArrayCart; // recupera funzione in gunction.js
    this.clearCart = functions.clearCart; // recupera funzione in gunction.js
  },
  data() {
    return {
      store,
      categoriesSelected: [],
      restaurants: [],
      visibleRestaurants: [],
      showingRestaurants: [],
    };
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

      axios
        .get(url)
        .then((risultato) => {
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
            console.error(
              "Ops... non riusciamo a comprendere ciò che hai richiesto."
            );
          } else if (result.status === 404) {
            console.error(
              "Ops... non riusciamo a trovare ciò che hai richiesto."
            );
          } else if (result.status === 500) {
            console.error(
              "Ops... ci scusiamo per l'inconveniente, stiamo spegnendo l'incendio."
            );
          }
        })
        .catch((errore) => {
          console.error(errore);
        });
    },
    // funzione search
    search(id_categoria) {
      //seleziono tutti i ristoranti
      this.restaurants = document.querySelectorAll(".card-restaurant");
      this.restaurants_box = document.getElementById("card-box");

      // controllo se una categoria è presente nell'array delle categorie selezionate e in caso lo pusho o lo rimuovo
      if (this.categoriesSelected.includes(id_categoria)) {
        var index = this.categoriesSelected.indexOf(id_categoria);
        //se seleziono almeno una categoria compare tutto il box
        this.categoriesSelected.splice(index, 1);
        console.log(this.categoriesSelected);
        if (this.categoriesSelected.length == 0) {
          //se non ci sono categorie selezionate non mostro il componente
          this.restaurants_box.classList.add("d-none");
          document.getElementById("restaurant_message").innerHTML = "";
        }
      } else {
        this.categoriesSelected.push(id_categoria);
        this.restaurants_box.classList.remove("d-none");
      }

      /*       if (this.categoriesSelected != []) {
        restaurants_box.classList.remove("d-none");
      } else if (this.categoriesSelected == []) {
        restaurants_box.classList = "container d-none";
      } */

      this.restaurants.forEach((restaurant) => {
        var metaCategories = restaurant
          .getAttribute("meta-categories")
          .split(",");
        var showRestaurant = true; // Assumiamo inizialmente che l'elemento debba essere mostrato
        this.showingRestaurants.push(restaurant);
        this.categoriesSelected.forEach((cat) => {
          if (!metaCategories.includes(cat.toString())) {
            // Se una delle categorie selezionate non è presente nell'array di categorie dell'elemento, non mostriamo l'elemento
            showRestaurant = false;
          }

          if (showRestaurant) {
            restaurant.classList.remove("d-none");
            //gestisce le slide e le carte al loro interno
          } else {
            restaurant.classList.add("d-none");
            this.showingRestaurants.splice(
              this.showingRestaurants.indexOf(restaurant),
              1
            );

            //gestisce le slide e le carte al loro interno
          }
        });
      });
      console.log(this.showingRestaurants);
    },
  },
};
</script>

<template>
  <JumboSwiper class="my-5" />

  <RestaurantSwiper />
  <div class="container">
    <hr class="my-4" style="color: #ff9900; min-height: 10px" />
  </div>

  <div class="container my-5">
    <div class="row text-center my-5">
      <h2>Scegli una categoria, Al resto ci pensiamo noi</h2>
    </div>
    <!-- categories checkbox -->
    <div class="d-flex justify-content-center gap-2">
      <div
        v-for="category in store.categories"
        class="btn-group mb-3 category-btn"
        :data-category-id="category.id"
        role="group"
        aria-label="Basic checkbox toggle button group"
      >
        <input
          @click="search(category.id)"
          hidden
          type="checkbox"
          name="categories[]"
          :id="'category' + category.id"
          :value="category.id"
          autocomplete="off"
        />
        <label
          class="btn form-label rounded-pill"
          style="background-color: #ff9900"
          :for="'category' + category.id"
        >
          {{ category.name }}
        </label>
      </div>
    </div>

    <div class="container">
      <hr class="my-4" style="color: #ff9900; min-height: 10px" />
    </div>

    <!-- componente che fa lo show dei ristoranti -->
    <RestaurantList />

    <!-- sezione degli sponsor  -->
    <section class="sponsor">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="sponsorLogo mt-5 d-flex justify-content-around">
              <img
                class="imageLogo img-fluid align-self-center"
                src="https://www.edigitalagency.com.au/wp-content/uploads/starbucks-logo-png.png"
                alt=""
              />
              <img
                class="imageLogo img-fluid align-self-center"
                src="https://www.edigitalagency.com.au/wp-content/uploads/McDonalds-logo-png.png"
                alt=""
              />
              <img
                class="imageLogo img-fluid align-self-center"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Burger_King_logo_%281999%29.svg/2024px-Burger_King_logo_%281999%29.svg.png"
                alt=""
              />
              <img
                class="imageLogo img-fluid align-self-center"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Dominos_pizza_logo.svg/1200px-Dominos_pizza_logo.svg.png"
                alt=""
              />
              <img
                class="imageLogo img-fluid align-self-center"
                src="https://upload.wikimedia.org/wikipedia/sco/thumb/b/bf/KFC_logo.svg/1200px-KFC_logo.svg.png"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use "../styles/general.scss";
</style>

<style scoped lang="scss">
// importo variabili

// ...qui eventuale SCSS di App.vue

input[type="checkbox"]:checked + label {
  background-color: #ff9900;
  color: #fff;
}

// css spnsor section

.sponsor {
  margin-top: 4rem;
}

.sponsorLogo {
  border: 1px solid white;
  width: 100%;
  height: 200px;
  background-color: rgb(6, 110, 124, 0.4);
  border-radius: 30px;
}

hr {
  height: 12px;
}
.imageLogo {
  max-width: 100%;
  max-height: 150px;
  transition: transform 0.4s ease;
  cursor: pointer;
}

.imageLogo:hover {
  transform: scale(1.2);
}
</style>
