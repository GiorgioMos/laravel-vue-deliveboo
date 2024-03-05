import { createRouter, createWebHistory } from "vue-router";

import AppHomePage from "./pages/AppHomePage.vue";
import RestaurantList from "./pages/RestaurantList.vue";
import RestaurantDetail from "./pages/RestaurantDetail.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: AppHomePage,
    },
    {
      path: "/restaurants",
      name: "restaurants",
      component: RestaurantList,
    },
    {
      path: "/restaurants/:id",
      name: "restaurant-detail",
      component: RestaurantDetail,
      props: true,
    },
    
  ],
});

export { router };
