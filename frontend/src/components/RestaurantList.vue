<script>
import RestaurantCard from "../components/RestaurantCard.vue";
import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios


export default {
    name: "RestaurantList",
    components: {
        RestaurantCard
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
    <div class="container">
        <div>
            <h1 class="text-center">Restaurants</h1>
            <div class="row justify-content-around">
                <RestaurantCard v-for="restaurant in store.restaurants" :item="restaurant" />
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


.container {
    min-height: 100vh;
}
</style>