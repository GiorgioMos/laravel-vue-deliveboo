<script>
import { store } from "../store.js" //state management



export default {
    name: "AppFooter",
    components: {
    },
    data() {
        return {
            store
        }
    },
    mounted() {
    },
    methods: {
    }
}
</script>

<template>
    <footer>
        <div class="container">
            <div class="row">
                <hr class="my-4 bg-white">
                <!-- Logo deliveboo -->
                <div class="col-4">
                    <div class="logoFooter">
                        <img class="logoDeliveboo" src="/img/logoDeliveboo.png" alt="">
                    </div>
                    <div>
                        <p class="fw-bold mt-5 mb-5">Scopri l'emozione del gusto a portata di clic con il nostro servizio di delivery food.</p>
                    </div>
                    <hr class="my-4 bg-white">
                    <!-- Icon Brands -->
                    <div class="iconFooter">
                        <!-- Facebook -->
                        <div class="circle">
                            <a class="btnIcon m-1" href="#" role="button">
                                <font-awesome-icon class="icon" icon="fa-brands fa-facebook" />
                            </a>
                        </div>

                        <!-- Twitter -->
                        <div class="circle">
                            <a class="btnIcon m-1" href="#" role="button">
                                <font-awesome-icon class="icon" icon="fa-brands fa-twitter" />
                            </a>
                        </div>

                        <!-- Instagram -->
                        <div class="circle">
                            <a class="btnIcon m-1" href="#" role="button">
                                <font-awesome-icon class="icon" icon="fa-brands fa-instagram" />
                            </a>
                        </div>

                        <!-- WhatsApp -->
                        <div class="circle">
                            <a class="btnIcon m-1" href="#" role="button">
                                <font-awesome-icon class="icon" icon="fa-brands fa-whatsapp" />
                            </a>
                        </div>
                    </div>
                    <!-- Copyright footer -->
                    <div class="mt-5" id="copyright">&copy; 2024 - 2024 www.deliveboo.it</div>
                </div>
                <!-- Link central column -->
                <div class="col-4">
                    <div class="linkFooter d-flex flex-column justify-content-center align-items-center ">
                        <div class="link">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="#">Ristoranti</a>
                                </li>
                                <li class="nav-item">
					                <router-link :to="{ name: 'about' }">
                                        <p>Chi Siamo</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Prodotti</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Image column dx -->
                <div class="col-4">
                    <h4 class="fw-bold">Seguici su Instagram</h4>
                    <div class="row">
                        <div class="boxImage">
                            <img src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b7fae62b9e7a_Instagram-02-restaurante-x-template.jpg"
                                alt="">
                        </div>
                        <div class="boxImage">
                            <img src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b70dea2b9e94_Instagram-01-restaurante-x-template.jpg"
                                alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="boxImage">
                            <img src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b767fd2b9e7d_Instagram-03-restaurante-x-template-p-500.jpeg"
                                alt="">
                        </div>
                        <div class="boxImage">
                            <img src="https://assets.website-files.com/61d3a7155d89b79cad2b9e32/61d3a7155d89b768c62b9e7b_Instagram-05-restaurante-x-template-p-500.jpeg"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped lang="scss">
@use '../styles/general.scss';

footer {
    margin-top: 15rem;
    margin-bottom: 5rem;
}

// Logo deliveboo 
.logoDeliveboo {
    width: 9rem;
}

.logoDeliveboo:hover {
    transition: transform 0.4s ease;
    transform: scale(1.1);
    cursor: pointer
}

.logoDeliveboo:not(:hover) {
    transition: transform 0.4s ease;
    transform: scale(1);
}

// Icon section
.iconFooter {
    display: flex;
    margin-top: 60px;
}

.icon {
    color: white;
    font-size: 18px;
}

.circle {
    width: 35px;
    height: 35px;
    border: 1px solid;
    border-radius: 50%;
    margin-right: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: box-shadow 0.3s;
}

.circle:hover {
    box-shadow: #ff9900 0px 8px 29px, #ff9900 0px 0px 21px, #ff9900 0px 4px 15px, #ff9900 0px 3px 60px, #ff9900 0px 0px 5px
}

.circle a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

// Link central column
.nav-item {
    text-decoration: none;
    margin-bottom: 60px
}

.nav-item a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}

.nav-item a:hover {
    color: #ff9900;
	transform: scale(1);
}

.linkFooter {
    height: 100%;
}

// Image column dx
.boxImage {
    width: 172px;
    height: 172px;
    padding: 10px;
}

.boxImage:hover {
    transition: transform 0.4s ease;
    transform: scale(1.1);
    cursor: pointer
}

.boxImage:not(:hover) {
    transition: transform 0.4s ease;
    transform: scale(1);
}

.boxImage img {
    width: 100%;
    object-fit: cover;
    border-radius: 15px;
}
</style>