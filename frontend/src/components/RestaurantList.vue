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
  <div id="card-box" class="d-none">
    <h3 class="text-center my-5">Potrebbero interessarti:</h3>

    <swiper
      :slidesPerView="3"
      :spaceBetween="30"
      :modules="modules"
      class="mySwiper"
      :autoplay="{ delay: 3000, disableOnInteraction: false }"
    >
      <swiper-slide v-for="restaurant in store.restaurants">
        <RestaurantCard :item="restaurant" id />
      </swiper-slide>
    </swiper>
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

.container {
  min-height: 100vh;
}
.swiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  text-align: center;

  /* Center slide text vertically */
}
</style>
