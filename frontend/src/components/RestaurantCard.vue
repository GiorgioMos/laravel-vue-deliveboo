<script>
export default {
    name: "RestaurantCard",
    props: ["item"],
    mounted() {
        
    },
    methods: {

    }
}
</script>

<template>
    <div class="col-3">
        <!-- item card -->
        <router-link :to="{ name: 'restaurant-detail', params: { id: item.id } }">
            <div class="card my-3 text-center" style="width: 18rem;">
                <div class="card-header bg-danger">
                    <h3>{{ item.name.toUpperCase() }}</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><a href="">Descrizione: {{ item.description }}</a></h4>
                    <h4 class="card-title"><a href="">Posizione: {{ item.address }}</a></h4>
                </div>
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
</style>