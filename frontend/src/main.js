import { createApp } from 'vue'
import App from './App.vue'

// importo bootstrap (js)
import * as bootstrap from 'bootstrap'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faHome } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faHome);

window.vue = {};
window.vue.App = createApp(App)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount('#app');
