<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <div class="grid grid-cols-3 gap-4">
                <div v-for="category in categories" :key="category">
                    <Link :href="route('client.categories.products.index', category.id)">{{ category.title }}</Link>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    name: "Index",
    layout: MainLayout,

    components: {
        Link
    },

    props: {
        categories: Array,
    },
}
</script>

<style scoped></style>