<template>
    <div class="p-4 border border-gray-200 bg-white">
        <Link :href="route('client.products.show', product.id)"><h3>{{ product.title }}</h3></Link>
        <img :src="product.preview_image_url" :alt="product.title">
        <div class="flex items-center justify-between">
            <p>{{ product.price }}</p>
            <p>{{ product.old_price }}</p>
        </div>
        <!--<div>
            <a href="#" class="block p-4 bg-indigo-600 text-white text-center">Buy</a>
        </div>-->
        <StoreAndUpdateCart :product="product"></StoreAndUpdateCart>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import StoreAndUpdateCart from '@/Components/Client/Cart/StoreAndUpdateCart.vue';

export default {
    name: "ProductItem",

    props: {
        product: Object,
    },

    components: {
        Link,
        StoreAndUpdateCart
    }
}
</script>

<style scoped></style>