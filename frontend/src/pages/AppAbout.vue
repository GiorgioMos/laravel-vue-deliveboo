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
                        <h2 class="fw-bold pt-5">Esplora il nostro viaggio culinario e scopri la passione dietro il
                            nostro
                            servizio
                            di <span class="text-warning"> delivery food </span> </h2>

                        <p class="mt-4 text-start">Benvenuto nel cuore pulsante della nostra avventura culinaria. La
                            nostra
                            storia non
                            è
                            solo un
                            racconto di consegne di cibo, ma un viaggio di passione, dedizione e amore per la
                            gastronomia.
                            Fondata da un gruppo di appassionati di cucina con un unico obiettivo: trasformare
                            l'esperienza
                            del delivery food in qualcosa di straordinario.</p>
                        <div class="aboutImgContainer mt-5">
                            <img class="aboutImg"
                                src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?q=80&w=3560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="aboutImgContainer mx-5">
                            <img class="aboutImg"
                                src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b782f32b9e9d_about-01-restaurante-x-template.jpg"
                                alt="">
                        </div>
                    </div>
                    <!-- Yellow rectangle -->
                    <div class="bottomOverlay"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="sponsor">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sponsorLogo mt-5 d-flex justify-content-around">
                        <img class="imageLogo img-fluid align-self-center"
                            src="https://www.edigitalagency.com.au/wp-content/uploads/starbucks-logo-png.png" alt="">
                        <img class="imageLogo img-fluid align-self-center"
                            src="https://www.edigitalagency.com.au/wp-content/uploads/McDonalds-logo-png.png" alt="">
                        <img class="imageLogo img-fluid align-self-center"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Burger_King_logo_%281999%29.svg/2024px-Burger_King_logo_%281999%29.svg.png"
                            alt="">
                        <img class="imageLogo img-fluid align-self-center"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Dominos_pizza_logo.svg/1200px-Dominos_pizza_logo.svg.png"
                            alt="">
                        <img class="imageLogo img-fluid align-self-center"
                            src="https://upload.wikimedia.org/wikipedia/sco/thumb/b/bf/KFC_logo.svg/1200px-KFC_logo.svg.png"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="aboutImgContainer mt-5">
                        <img class="aboutImg"
                            src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b718652b9e9f_about-03-restaurante-x-template.jpg"
                            alt="">
                    </div>

                </div>
                <div class="col-6">
                    <div class="d-flex flex-column align-items-center mt-5">
                        <h2 class="fw-bold mt-5">La nostra Missione e i nostri Valori</h2>
                    </div>
                    <p>
                        In <span class="text-warning">DeliveBoo</span>, ci impegniamo a portare gioia e
                        soddisfazione a
                        ogni cliente attraverso l'esperienza culinaria più prelibata e conveniente possibile. I nostri
                        valori
                        fondamentali guidano ogni aspetto del nostro lavoro e ci spingono a superare le aspettative dei
                        nostri
                        clienti ogni giorno.
                    </p>
                    <div class="text-center">
                        <button href="" class="buttonYellow mt-5">Ordina adesso</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="community mt-3">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex flex-column align-items-center mt-5">
                        <h2 class="fw-bold mt-5">Impegno verso la Comunità</h2>
                    </div>
                    <p>
                        Il nostro impegno verso la comunità non è solo un dovere, ma una parte integrante della nostra
                        identità aziendale. Ci sforziamo di essere un modello di responsabilità sociale d'impresa e di
                        ispirare positivamente gli altri a seguire il nostro esempio.
                    </p>
                    <div class="text-center">
                        <button href="" class="buttonYellow mt-5">Ordina adesso</button>
                    </div>
                </div>
                <div class="col-6">
                    <div class="aboutImgContainer mt-5">
                        <img class="aboutImg"
                            src="https://images.unsplash.com/photo-1519996409144-56c88c9aa612?q=80&w=3687&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carouselCard">
        <div class="container">
            <h2 class="fw-bold text-center"> Ordina piatti provenienti da tutto il mondo </h2>
            <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?q=80&w=3687&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="ramen">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Ramen</h3>
                                        <p class="card-text">Cina</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1604382355076-af4b0eb60143?q=80&w=3648&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="pizza">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Pizza</h3>
                                        <p class="card-text">Italia</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?q=80&w=2270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="sushi">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Sushi</h3>
                                        <p class="card-text">Giappone</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1565299585323-38d6b0865b47?q=80&w=3480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="tacos">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Tacos</h3>
                                        <p class="card-text">Messico</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1496116218417-1a781b1c416c?q=80&w=3570&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="gyoza">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Gyoza</h3>
                                        <p class="card-text">Cina</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1666819476628-2f3afb0ca147?q=80&w=3442&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="pita">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Pita Gyros</h3>
                                        <p class="card-text">Grecia</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1523798724321-364e1951df59?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="kfc">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Fast Food</h3>
                                        <p class="card-text">America</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1606471191009-63994c53433b?q=80&w=2126&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="card-img-top" alt="indian">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold">Indiano</h3>
                                        <p class="card-text">India</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
</template>


<style lang="scss">
// importo il foglio di stile generale dell'applicazione, non-scoped
@use '../styles/general.scss';
</style>

<style scoped lang="scss">
// HeroAbout section

h2 {
    font-size: 50px;
}

.aboutImgContainer {
    overflow: hidden;
    border-radius: 40px;
    height: 600px;
    animation: fadeInAnimation 1s ease-in;
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

.aboutImgContainer:hover img {
    transition: transform 0.4s ease;
    transform: scale(1.1);
    cursor: pointer;
}

.aboutImgContainer:not(:hover) img {
    transition: transform 0.4s ease;
    transform: scale(1);
}

.aboutImg {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 40px;
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
    width: 75%;
    height: 670px;
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

// Sponsor section

.sponsor {
    margin-top: 200px;
}

.sponsorLogo {
    border: 1px solid white;
    width: 100%;
    height: 200px;
    background-color: rgb(6, 110, 124, 0.4);
    border-radius: 30px;

}

.imageLogo {
    max-width: 100%;
    max-height: 150px;
    transition: transform 0.4s ease;
    cursor: pointer;
}

.imageLogo:hover {
    transform: scale(1.2);
}

// Mission section

.mission {
    margin-top: 200px;
}

.buttonYellow {
    padding: 20px 40px;
    border: 1px solid transparent;
    border-radius: 80px;
    background-color: #f9b44d;
    color: white;
}

// Carousel section
.carouselCard {
    margin-top: 100px;
}

.carousel-item img {
    height: 400px;
    width: 100%;
    object-fit: cover;
}

.footer {
    height: 500px;
    background-color: teal;
    margin-top: 100px;
}

.card {
    border: none;
}



// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di App.vue</style>