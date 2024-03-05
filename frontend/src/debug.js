//Attenzione: accrocchio di livello leggendario, per soli scopi didattici

export default function register(component) {
    if (!window.vue[component.$options.name]) {
        window.vue[component.$options.name] = [];
    }
    window.vue[component.$options.name].push(component);
}