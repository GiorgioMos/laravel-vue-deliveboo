<script>
import functions from "../functions.js";

export default {
  name: "RestaurantCard",
  props: ["item"],
  data() {
    return {
      id_categories: [],
    };
  },
  created() {
    this.getImage = functions.getImage;
  },
  mounted() {
    this.item.category.forEach((element) => {
      this.id_categories.push(element.id);
    });

    this.id_categories = this.id_categories.join(",");
  },
  methods: {},
};
</script>

<template>
  <!-- item card -->
  <!--   <div class="col-3">
    <div
      :meta-categories="this.id_categories"
      class="text-center card m-2"
      style="height: 30rem"
    >
      <router-link :to="{ name: 'restaurant-detail', params: { id: item.id } }">
        <div class="card-header bg-transparent" style="height: 5rem">
          <p class="fw-bold">{{ item.name.toUpperCase() }}</p>
        </div>

        <div class="imgBoxShow rounded">
          <img class="cardImg rounded my-1" :src="getImage(item.img)" alt="" />
        </div>

        <div class="card-body">
          <p class="fw-bold">
            <a href=""> {{ item.description }}</a>
          </p>

          <p class="">
            <a href="">{{ item.address }}</a>
          </p>

          <p
            v-for="cat in item.category"
            class="rounded-pill btn btn-outline-warning mx-1 disabled fs-6"
          >
            <a href="">{{ cat.name }}</a>
          </p>
        </div>
      </router-link>
    </div>
  </div> -->
  <div
    class="card-restaurant px-5 my-5 mb-5"
    id="card-display"
    :meta-categories="this.id_categories"
  >
    <router-link
      :to="{ name: 'restaurant-detail', params: { id: item.id } }"
      class="text-decoration-none fw-bold"
      id="router-link"
    >
      <div class="text-box">
        <div class="text-center">
          <p style="color: #ff9900" class="fw-bold fs-5">{{ item.name }}</p>
          <p class="my-4">{{ item.address }}</p>

          <ul
            class="list-group list-group-horizontal justify-content-center flex-wrap my-4"
          >
            <li
              class="list-group-item rounded-pill btn m-2"
              style="background-color: #ff9900"
              v-for="cat in item.category"
            >
              {{ cat.name }}
            </li>
          </ul>
        </div>
      </div>
      <div class="imageBox" style="position: relative">
        <img :src="getImage(item.img)" class="restaurant-image" />

        <div class="background_square"></div>
      </div>
    </router-link>
  </div>
</template>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di TagList
.imageBox img {
  width: 90%;
  height: 90%;
  object-fit: cover;

  border-radius: 30px;
  margin: 0;
}

.background_square {
  padding: 2rem;
  width: 80%;
  height: 75%;
  transform: rotate(-2deg);
  background-color: #ff9900;
  border-radius: 30px;
  z-index: -1;
  position: absolute;
  top: 10%;
  right: 7%;
}
.imageBox {
  padding: 2rem;
  width: 60%;
  height: 100%;
  transform: rotate(-1deg);
  z-index: 1;
}

.list-group {
  text-decoration: none;
}
.list-group-item {
  background-color: transparent;
  border-color: #060113;

  font-size: small;
}

.card {
  color: white;

  background-color: #060113;
  border-radius: 30px;
  height: 100%;
  padding: 0;
}
.text-box {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40%;
  height: 100%;
}

#router-link {
  padding: 2rem;
  color: white;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-content: center;
  height: 100%;
  font-size: small;
  border: solid 1px #060113;
}

#router-link:hover {
  /* border: solid 1px #ff9900; */
  border-radius: 30px;
  background-color: rgba($color: white, $alpha: 0.05);
  transform: scale(1.1);
  transition: 0.2s ease;
}
</style>
