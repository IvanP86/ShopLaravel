<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Products</Link>
        </div>
        <div class="mb-4">
            <table class="table-auto w-full bg-white border border-gray-300">
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">ID</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.id }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Title</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.title }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Description</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.description }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Content</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.content }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Price</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.price }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Old Price</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.old_price }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Quantity</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.qty }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Category</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.category_id }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Product Group</td>
                        <td class="border border-gray-300 px-4 py-2">{{ product.product_group_id }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="flex justify-between">
                <div v-for="image in product.images">
                    <img :src="image.url" alt="product.title">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: "Show",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        product: Array
    }
}
</script>

<style scoped></style>