<template>
    <aside class="w-1/4 bg-gray-900 min-h-screen">
        <nav>

        </nav>
    </aside>
    <article class="w-3/4 bg-gray-50 p-4">
        <div class="mb-4">
            <template v-for="breadcrumb in breadCrumbs" :key="breadcrumb">
                <Link :href="route('client.categories.products.index', breadcrumb.id)">
                {{ breadcrumb.title }}
                </Link>
                <span> / </span>
            </template>
            <span>{{ category.title }}</span>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in products" :product="product" :key="product"></ProductItem>
        </div>
    </article>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import ProductItem from '@/Components/Client/Product/ProductItem.vue';

export default {
    name: "ProductIndex",
    layout: MainLayout,

    components: {
        Link, ProductItem
    },

    props: {
        products: Array,
        breadCrumbs: Array,
        category: Object
    }
}
</script>

<style scoped></style>