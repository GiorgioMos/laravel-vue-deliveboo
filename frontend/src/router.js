import { createRouter, createWebHistory } from "vue-router";

import AppHomePage from "./pages/AppHomePage.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: AppHomePage,
    },
    // {
    //   path: "/events/:id",
    //   name: "Event-detail",
    //   component: EventDetail,
    //   props: true,
    // },
    
  ],
});

export { router };
