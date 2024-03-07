import { reactive } from 'vue'

export const store = reactive({
    restaurants: [],
    categories: [],
    apiRestaurants: "http://localhost:8000/api/",
    restaurantsEndPoint: "restaurants/",
    categoriesEndPoint: "categories/",
    // variabile per storare il ristorante dei prodotti selezionati per primi 
    currentCartRestaurant: "",
});