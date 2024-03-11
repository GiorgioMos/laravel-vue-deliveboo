<script>
import RestaurantCard from "../components/RestaurantCard.vue";
import { store } from "../store.js"; //state management
import axios from "axios"; //importo Axios

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";

// import required modules
import { Autoplay, Pagination } from "swiper/modules";

export default {
  name: "RestaurantList",
  components: {
    RestaurantCard,
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      store,
    };
  },
  setup() {
    return {
      modules: [Pagination, Autoplay],
    };
  },
  mounted() {
    this.getRestaurants();
  },
  methods: {
    getRestaurants() {
      console.log("RestaurantList does things");

      let url = this.store.apiRestaurants + this.store.restaurantsEndPoint;

      axios
        .get(url)
        .then((risultato) => {
          // if di controllo
          if (risultato.status === 200) {
            if (risultato.data.success) {
              this.store.restaurants = risultato.data.payload;
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
  },
};
</script>

<template>
  <div id="card-box" class="d-none row">
    <RestaurantCard
      class="col-lg-6 col-12"
      v-for="restaurant in store.restaurants"
      :item="restaurant"
    />
  </div>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use "../styles/general.scss";
</style>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue
</style>
