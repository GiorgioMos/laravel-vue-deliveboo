<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/navigation';


// import required modules
import { Autoplay, Navigation } from 'swiper/modules';



export default {
    name: "JumboSwiper",
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            modules: [Autoplay, Navigation],
            img: ['https://staticcookist.akamaized.net/wp-content/uploads/sites/21/2020/02/cucina-cinese-migliori-ristoranti-in-italia.jpg', 'https://www.opsveg.com/wp-content/uploads/2020/06/home-ops-ristorante-veg-1980x1322.jpg', 'https://media-assets.vanityfair.it/photos/61e444841e21bc3bd54b5357/1:1/w_2832,h_2832,c_limit/pizza%20tendenze.jpg', 'https://media.gqitalia.it/photos/5e57f3f3164b2a0008965a13/16:9/w_2560%2Cc_limit/GettyImages-514067836.jpg', 'https://images.unsplash.com/photo-1513185158878-8d8c2a2a3da3?q=80&w=3570&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' ]
        }
    },
    methods: {
    
    }
}
</script>

<template>
	<swiper :slidesPerView="1" :spaceBetween="2" :loop="true" :autoplay="{ delay: 4000, disableOnInteraction: false }" :modules="modules">
        <swiper-slide v-for="img in this.img" class="text-center">
            <!-- box1 -->
            <div class="box text-center">
                <!-- img -->
                <div class="box-img">
                    <img :src="img" alt="">
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>

<style scoped>
img {
    max-width: 100%;
    min-height: 100%;
    object-fit: cover;
}

.box {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    height: 50rem;
}
</style>