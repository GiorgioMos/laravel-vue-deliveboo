<script>
export default {
    name: "AppNavbar",
    data() {
        return {
            menuItems: [
				{
					routeName: "home",
					label: "home"
				},
			],
        }
    },
}
</script>

<template>
    <header class="bg-info">
		<div class="container py-2">
			<h1>
				<div class="row text-center">
					<div class="col-3 text-start">
						<a href=".">
							<link rel="stylesheet" href="/public/router.png">
							<img src="/public/router.png" alt="">
						</a>
					</div>
					<div v-for="(item, index) in menuItems" :key="index" class="col-2 d-flex justify-content-center align-items-center">
						<router-link :to="{name: item.routeName}" class="nav-link">
							<h3>{{ item.label }}</h3>
						</router-link>
					</div>
				</div>
			</h1>
		</div>
	</header>
</template>

<style scoped>
img {
	width: 4rem;
}
</style>