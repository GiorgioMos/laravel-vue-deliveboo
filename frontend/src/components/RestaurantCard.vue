<script>
export default {
  name: "RestaurantCard",
  props: ["item"],
  data() {
    return {
      id_categories: [],
    };
  },
  mounted() {
    this.item.category.forEach((element) => {
      this.id_categories.push(element.id);
    });

    this.id_categories = this.id_categories.join(",");
  },
  methods: {
    getImage(img) {
      let image;
      if (img.startsWith("http")) {
        image = img;
      } else {
        image = asset("storage/" + img);
      }

      return new URL(image, import.meta.url).href;
    },
  },
};
</script>

<template>
  <!-- item card -->
  <div
    :meta-categories="this.id_categories"
    class="col-2 text-center card mx-1"
  >
    <router-link :to="{ name: 'restaurant-detail', params: { id: item.id } }">
      <div class="card-header bg-transparent" style="height: 5rem">
        <p class="fw-bold my-2">{{ item.name.toUpperCase() }}</p>
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
        <h4
          v-for="cat in item.category"
          class="rounded-pill btn btn-outline-warning mx-1 disabled"
        >
          <a href="">{{ cat.name }}</a>
        </h4>
      </div>
    </router-link>
  </div>
</template>

<style scoped lang="scss">
// importo variabili
// @use './styles/partials/variables' as *;

// ...qui eventuale SCSS di TagList
a {
  text-decoration: none;
  color: black;
}

img {
  width: 100%;
}
</style>
