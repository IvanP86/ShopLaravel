<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Product Groups</Link>
        </div>
        <div>
            <table class="table-auto w-full bg-white border border-gray-300">
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">ID</td>
                        <td class="border border-gray-300 px-4 py-2">{{ productGroup.id }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Title</td>
                        <td class="border border-gray-300 px-4 py-2">{{ productGroup.title }}</td>
                    </tr>
                </tbody>
            </table>
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
        productGroup: Object
    }
}
</script>

<style scoped></style>