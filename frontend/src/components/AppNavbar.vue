<script>
export default {
  name: "AppNavbar",
  data() {
    return {
      menuItems: [
        {
          name: "registrazione",
          label: "Registrati",
        },
        {
          name: "login",
          label: "Accedi",
        },
        {
          routeName: "home",
          label: "About Us",
        },

        /* 		{
          routeName: "aboutUs",
          label: "About Us"
        },
        {
          routeName: "login",
          label: "Login"
        },
        {
          routeName: "register",
          label: "Register"
        },
 */
      ],
    };
  },
};
</script>
<!-- scrivere manualmente link e componenti singoli della navbar -->

<!-- logo a sinistra pagine al centro che riportano ai componenti e a destra carrello lohgin e registrazione -->
<template>
  <nav class="navbar navbar-expand-lg">
  <div class="container">
      <a class="navbar-brand text-light" href="/">LOGO</a>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="page-navigation" href="#">Ristoranti</a>
      </li>
      <li class="nav-item">
          <a class="page-navigation" href="/about">Chi Siamo</a>
      </li>
      <li class="nav-item">
        <a class="page-navigation" href="#">Prodotti</a>
      </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn rounded-pill btn-outline-light px-4" href="#" id="shopping-cart">
            <font-awesome-icon icon="fa-solid fa-cart-shopping" />
          </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light rounded-pill px-4 mx-3" href="#">Accedi</a>
        </li>
        <li class="nav-item">
          <a class="btn rounded-pill bg-warning px-4" href="#">Registrati</a>
        </li>
      </ul>
    </div>
  </nav>

  <!--   <nav class="navbar border-body">
          <div class="container">
            <a class="navbar-brand text-light" href=".">Logo</a>
          </div>
          <div>
            <a href="" class="navbar-text">sdfg</a>
            <a href="" class="nav-link">asdf</a>
            <a href="" class="nav-link">asdf</a>
          </div>
        </nav> -->

  <!-- <div class="col-3 text-start">
      						<a href=".">
      							<link rel="stylesheet" href="/public/router.png">
      							<img src="/public/router.png" alt="">
      						</a>
      					</div> -->
  <!-- <div v-for="(item, index) in menuItems" :key="index" class="col-2 d-flex justify-content-center align-items-center">
      						<router-link :to="{name: item.routeName}" class="nav-link">
      							<h3>{{ item.label }}</h3>
      						</router-link>
      					</div> -->
</template>

<style scoped>
.page-navigation {
  color: white;
  text-decoration: none;
  margin: 0 2rem;
}

.page-navigation:hover {
  text-decoration: underline;
  color: yellow;
}

font-awesome-icon {
  color: yellow;
}

font-awesome-icon:hover {
  color: white;
}
</style>
