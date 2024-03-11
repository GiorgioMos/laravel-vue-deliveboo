import { createRouter, createWebHistory } from "vue-router";

import AppHomePage from "./pages/AppHomePage.vue";
import Checkout from "./pages/Checkout.vue";
import RestaurantDetail from "./pages/RestaurantDetail.vue";
import AppAbout from "./pages/AppAbout.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: AppHomePage,
    },
    {
      path: "/restaurants/:id",
      name: "restaurant-detail",
      component: RestaurantDetail,
      props: true,
    },
    {
      path: "/about",
      name: "about",
      component: AppAbout,
    },
    {
      path: "/checkout",
      name: "checkout",
      component: Checkout,
    },
    /*     {
      path: "/",
      name: "restaurants",
      component: RestaurantListPage,
    }, */
    /*       path: "",
          name: "",
          component: ,
          props: true,*/
  ],
});

export { router };
