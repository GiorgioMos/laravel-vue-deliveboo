import { reactive } from 'vue'

export const store = reactive({
    restaurants: [],
    categories: [],
    apiRestaurants: "http://localhost:8000/api/",
    restaurantsEndPoint: "restaurants/",
    categoriesEndPoint: "categories/",
    ArrayIdsInCart: []
    
});