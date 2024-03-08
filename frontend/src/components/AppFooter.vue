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
                <div class="col-4 text-center bg-primary">
                    <div class="logoFooter"></div>
                    <div class=""></div>
                    <div class="iconFooter">
                    </div>
                </div>
                <div class="col-4 text-center bg-secondary">Item</div>
                <div class="col-4 text-center bg-danger">Img</div>
            </div>
        </div>
    </footer>
</template>

<style scoped lang="scss">
@use '../styles/general.scss';

.iconFooter {
    height: 100px;
}
</style>