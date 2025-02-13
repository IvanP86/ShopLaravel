<template>
    <section class="w-full p-4 border-b border-gray-100">
        <header>
            Market Admin
        </header>
    </section>
    <section class="flex">
        <aside class="w-1/4 bg-gray-900 min-h-screen">
            <nav>
                <Link :href="route('dashboard')" class="block p-4 text-gray-200 border-b border-gray-600">Dashboard</Link>
                <Link :href="route('admin.product-parents.index')" class="block p-4 text-gray-200 border-b border-gray-600">Group products</Link>
                <Link :href="route('admin.products.index')" class="block p-4 text-gray-200 border-b border-gray-600">Products</Link>
                <Link :href="route('admin.categories.index')" class="block p-4 text-gray-200 border-b border-gray-600">Categories</Link>
                <Link :href="route('admin.params.index')" class="block p-4 text-gray-200 border-b border-gray-600">Params</Link>
            </nav>
        </aside>
        <article class="w-3/4 bg-gray-50 p-4"><slot/></article>
    </section>
    <section>
        <footer></footer>
    </section>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "AdminLayout",
    components: {
        Link
    }
}

</script>

<stylt scoped>

</stylt>