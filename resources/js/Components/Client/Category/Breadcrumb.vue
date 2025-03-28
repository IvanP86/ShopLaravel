<template>
    <div class="mb-4">
        <template v-for="breadcrumb in breadCrumbs" :key="breadcrumb">
            <Link :href="route('client.categories.products.index', breadcrumb.id)">
            {{ breadcrumb.title }}
            </Link>
            <span> / </span>
        </template>
        <span>{{ title }}</span>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    name: "Breadcrumb",

    props:{
        breadCrumbs: Array,
        title: String
    },

    components: {
        Link
    }
}
</script>

<style scoped></style>