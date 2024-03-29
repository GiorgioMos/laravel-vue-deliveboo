import { createApp } from "vue";
import App from "./App.vue";

// importo bootstrap (js)
import * as bootstrap from "bootstrap";

/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import { faHome, faShoppingCart, faLocation, faCity, faPhone, faPlus, faMinus, faMoneyBill } from "@fortawesome/free-solid-svg-icons";
import { faFacebook, faInstagram, faTwitter, faWhatsapp, faYoutube } from "@fortawesome/free-brands-svg-icons";

// importo il router
import { router } from "./router";

/* add icons to the library */
library.add(faHome, faShoppingCart, faFacebook, faInstagram, faTwitter, faWhatsapp, faYoutube, faLocation, faCity, faPhone, faPlus, faMinus, faMoneyBill);


window.vue = {};
window.vue.App = createApp(App)
  .use(router)
  .component("font-awesome-icon", FontAwesomeIcon)
  .mount("#app");
