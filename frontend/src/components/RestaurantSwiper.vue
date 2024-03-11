<script>
import RestaurantCardBig from "../components/RestaurantCardBig.vue";
import { store } from "../store.js"; //state management
import axios from "axios"; //importo Axios
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/navigation";

// import required modules
import { Autoplay, Navigation } from "swiper/modules";

export default {
  name: "RestaurantSwiper",
  components: {
    Swiper,
    SwiperSlide,
    RestaurantCardBig,
  },
  data() {
    return {
      store,
      modules: [Autoplay, Navigation],
    };
  },
  mounted() {
    this.getRestaurants();
    console.log(store.restaurants);
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
  <div class="container">
    <h1 class="text-center section-title fs-1 fw-bold">I Ristoranti:</h1>
    <swiper
      :slidesPerView="1"
      :spaceBetween="30"
      :loop="true"
      :autoplay="{ delay: 2500, disableOnInteraction: false }"
      :modules="modules"
      class="box"
    >
      <swiper-slide v-for="restaurant in store.restaurants">
        <RestaurantCardBig :item="restaurant" />
      </swiper-slide>
    </swiper>
  </div>
</template>

<style scoped>
.section-title {
  margin: 8rem 0 3rem 0;
}
.box {
  display: flex;
  justify-content: center;

  align-content: center;
  overflow: hidden;
  margin: 3rem 0 6rem 0;
  height: 33rem;
}
</style>
