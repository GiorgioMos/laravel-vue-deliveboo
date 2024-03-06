<script>

import { store } from "../store.js" //state management
import axios from 'axios'; //importo Axios



export default {
    name: "AppAbout",
    components: {
    },
    data() {
        return {
            store
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            let url = this.store.apiRestaurants + this.store.categoriesEndPoint;

            axios.get(url).then(risultato => {
                // if di controllo
                if (risultato.status === 200) {
                    if (risultato.data.success) {
                        this.store.categories = risultato.data.payload;
                    } else {
                        // controllare statusCode, presenza e veridicità di data.success
                        console.error("qualcosa è andato storto...");
                    }
                } else if (result.status === 301) {
                    console.error("Ops... ciò che cerchi non si trova più qui.");
                } else if (result.status === 400) {
                    console.error("Ops... non riusciamo a comprendere ciò che hai richiesto.");
                } else if (result.status === 404) {
                    console.error("Ops... non riusciamo a trovare ciò che hai richiesto.");
                } else if (result.status === 500) {
                    console.error("Ops... ci scusiamo per l'inconveniente, stiamo spegnendo l'incendio.");
                }
            }).catch(errore => {
                console.error(errore);
            });
        }
    }
}
</script>

<template>
    <section class="heroAbout">
        <!-- About Section -->
        <div class="container">
            <div class="row">
                <div class="heroSection d-flex">
                    <div class="col-6">
                        <!-- First Title Hero -->
                        <h2 class="fw-bold pt-5">Esplora il nostro viaggio culinario e scopri la passione dietro il nostro
                            servizio
                            di <span class="text-warning"> delivery food </span> </h2>

                        <p class="mt-4 text-start">Benvenuto nel cuore pulsante della nostra avventura culinaria. La nostra
                            storia non
                            è
                            solo un
                            racconto di consegne di cibo, ma un viaggio di passione, dedizione e amore per la gastronomia.
                            Fondata da un gruppo di appassionati di cucina con un unico obiettivo: trasformare l'esperienza
                            del delivery food in qualcosa di straordinario.</p>

                        <img class="aboutImg mt-5"
                            src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b7cab22b9e9e_about-02-restaurante-x-template.jpg"
                            alt="">
                    </div>
                    <div class="col-6">
                        <img class="aboutImg mx-5"
                            src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b782f32b9e9d_about-01-restaurante-x-template.jpg"
                            alt="">
                    </div>
                    <!-- Yellow rectangle -->
                    <div class="bottomOverlay"></div>
                </div>
            </div>
        </div>
    </section>

    <section class=""></section>
</template>

<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use '../styles/general.scss';
</style>

<style scoped lang="scss">
h2 {
    font-size: 50px;
}

.aboutImg {
    width: 100%;
    border-radius: 40px;
    animation: fadeInAnimation 1s ease-in forwards;
}

// Animation first Image 
@keyframes fadeInAnimation {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.textAbout {
    display: flex;
    align-content: center;
}

.heroSection {
    margin-top: 10rem;
}

.bottomOverlay {
    position: absolute;
    left: 0;
    top: 800px;
    width: 70%;
    height: 70%;
    background-color: #f9b44d;
    z-index: -1;
    animation: slideFromLeftAnimation 4s ease forwards;
}

// Animation yellow rectangle 
@keyframes slideFromLeftAnimation {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }

    to {
        transform: translateX(0);
        opacity: 1;
    }
}

// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue
</style>