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
        image = "http://localhost:8000/storage/" + img;
      }
      return new URL(image, import.meta.url).href;
    },
  },
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
  <div class="card d-flex" :meta-categories="this.id_categories">
    <router-link
      :to="{ name: 'restaurant-detail', params: { id: item.id } }"
      class="text-decoration-none fw-bold"
      id="router-link"
    >
      <div class="text-box px-4">
        <div class="text-center">
          <h2 style="color: #ff9900" class="fw-bold">{{ item.name }}</h2>
          <p class="my-4">{{ item.address }}</p>
          <span>
            {{ item.description }}
          </span>

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

.imageBox:hover img {
  transition: transform 0.4s ease;
  transform: scale(1.1);
  cursor: pointer;
}
.imageBox:not(:hover) img {
  transition: transform 0.4s ease;
  transform: scale(1);
}
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
  height: 80%;
  transform: rotate(-1deg);
  background-color: #ff9900;
  border-radius: 30px;
  z-index: -1;
  position: absolute;
  top: 10%;
  right: 5%;
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
  color: white;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-content: center;
  height: 100%;
}

/* // ...qui eventuale SCSS di TagList




a {
  text-decoration: none;
  color: black;
}

.imageBox {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  height: 10rem;
  width: 100%;
}

.imageBox img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.__area {
  color: #7c7671;
  margin-top: 100px;
}

.__card {
  max-width: 350px;
  margin: auto;
  cursor: pointer;
  position: relative;
  display: inline-block;
  color: unset;
}
.__card:hover {
  color: unset;
  text-decoration: none;
}
.__img {
  border-radius: 10px;
}

.__favorit {
  background-color: #fff;
  border-radius: 8px;
  color: #fc9d52;
  position: absolute;
  right: 15px;
  top: 8px;
  padding: 3px 4px;
  font-size: 22px;
  line-height: 100%;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  z-index: 1;
  border: 0;
}
.__favorit:hover {
  background-color: #fc9d52;
  color: #fff;
  text-decoration: none;
}
.__card_detail {
  box-shadow: 0 4px 15px rgba(175, 77, 0, 0.13);
  padding: 13px;
  border-radius: 8px;
  margin: -30px 10px 0;
  position: relative;
  z-index: 2;
  background-color: #fff;
}
.__card_detail h4 {
  color: #474340;
  line-height: 100%;
  font-weight: bold;
}
.__card_detail p {
  font-size: 13px;
  font-weight: bold;
  margin-bottom: 0.4rem;
}
.__type span {
  background-color: #feefe3;
  padding: 5px 10px 7px;
  border-radius: 5px;
  display: inline-block;
  margin-right: 10px;
  font-size: 12px;
  color: #fc9d52;
  font-weight: bold;
  line-height: 100%;
}
.__detail {
  margin-top: 5px;
}
.__detail i {
  font-size: 21px;
  display: inline-block;
  vertical-align: middle;
}
.__detail i:nth-child(3) {
  margin-left: 15px;
}
.__detail span {
  font-size: 16px;
  display: inline-block;
  vertical-align: middle;
  margin-left: 2px;
} */
</style>
