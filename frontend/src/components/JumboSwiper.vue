<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/navigation";

// import required modules
import { Autoplay, Navigation } from "swiper/modules";

export default {
  name: "JumboSwiper",
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      modules: [Autoplay, Navigation],
      img: [
        "https://images.unsplash.com/photo-1617196034738-26c5f7c977ce?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://staticcookist.akamaized.net/wp-content/uploads/sites/21/2020/02/cucina-cinese-migliori-ristoranti-in-italia.jpg",
        "https://images.unsplash.com/photo-1523986371872-9d3ba2e2a389?q=80&w=2369&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://media-assets.vanityfair.it/photos/61e444841e21bc3bd54b5357/1:1/w_2832,h_2832,c_limit/pizza%20tendenze.jpg",
        "https://images.unsplash.com/photo-1542367592-8849eb950fd8?q=80&w=2531&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1513185158878-8d8c2a2a3da3?q=80&w=3570&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
      ],
    };
  },
  methods: {},
};
</script>

<template>
  <div class="bottomOverlay"></div>
  <div class="container mt-5">
    <div class="row">
      <!-- colonna di destra -->
      <div class="col-6">
        <swiper
          :slidesPerView="1"
          :spaceBetween="2"
          :loop="true"
          :autoplay="{ delay: 2000, disableOnInteraction: false }"
          :modules="modules"
          class="swiperOptions"
        >
          <swiper-slide v-for="img in this.img" class="text-center">
            <!-- box1 -->
            <div class="box">
              <!-- img -->
              <div class="box-img">
                <img :src="img" alt="" />
              </div>
            </div>
          </swiper-slide>
        </swiper>
      </div>

      <!-- colonna di sinistra -->
      <div class="col-6 text-box">
        <h1 class="my-4 fw-bold" style="color: #ff9900">
          Deliveboo: Gusta l'Autentica Cucina a Casa Tua
        </h1>
        <p class="fw-bold" style="color: #060113">
          Scopri i sapori genuini delle ricette tradizionali con un semplice
          clic. Concediti un viaggio gastronomico senza dover uscire di casa.
          Ordina adesso e gusta l'autenticità comodamente sul divano!
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.swiperOptions:hover img {
  transition: transform 0.4s ease;
  transform: scale(1.1);
  cursor: pointer;
}

.swiperOptions {
  border-radius: 30px;
}
.box-img {
  width: 100%;
  height: 100%;

  overflow: hidden;
}

img {
  width: 100%;
  height: 100%;
  border-radius: 30px;
  object-fit: cover;
}

.box {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  height: 40rem;
  width: 100%;
}

.text-box {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 6rem;
}

.bottomOverlay {
  position: absolute;
  left: 0;
  top: 530px;
  width: 85%;
  height: 400px;
  background-color: #ff9900;
  border-radius: 0 30px 30px 0;
  z-index: -1;
  animation: slideFromLeftAnimation 4s ease forwards;
}

@keyframes slideFromLeftAnimation {
  from {
    transform: translateX(-100%);
    opacity: 0;
  }

  to {
    transform: translateX(0);
    opacity: 1;
  }
}
</style>
