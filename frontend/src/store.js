import { reactive } from 'vue'

export const store = reactive({
    restaurants: [],
    apiRestaurants: "http://localhost:8000/api/",
    restaurantsEndPoint: "restaurants/",
});