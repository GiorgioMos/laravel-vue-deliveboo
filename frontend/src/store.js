import { reactive } from 'vue'

export const store = reactive({
    restaurants: [],
    categories: [],
    products: [],
    apiRestaurants: "http://localhost:8000/api/",
    restaurantsEndPoint: "restaurants/",
    categoriesEndPoint: "categories/",
    productsEndPoint: "products/",
    ArrayIdsInCart: []
    
});