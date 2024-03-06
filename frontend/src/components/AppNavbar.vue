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

<template>
  <nav class="navbar navbar-light mt-3 bg-">
    <div class="container">
      <div class="col-6">
        <a class="navbar-brand text-light" href=".">Logo</a>
      </div>

      <div v-for="(item, index) in menuItems" :key="index" class="nav-link">
        <router-link :to="{ name: item.routeName }" class="nav-link">
          {{ item.label }}
        </router-link>
      </div>
    </div>
  </nav>

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

<style scoped></style>
