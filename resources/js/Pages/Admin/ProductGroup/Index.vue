<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.create')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Add</Link>
        </div>
        <div>
            <table class="table-auto w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="productGroup in productGroupsData">
                        <td class="border border-gray-300 px-4 py-2">{{ productGroup.id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <Link :href="route('admin.product-groups.show', productGroup.id)">{{ productGroup.title }}</Link>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 flex">
                            <Link :href="route('admin.product-groups.edit', productGroup.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 cursor-pointer text-emerald-500 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            </Link>
                            <svg @click.prevent="deleteGroup(productGroup)" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="text-red-500 size-5 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>

                        </td>
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
    name: "Index",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        productGroups: Array
    },

    data(){
        return {
            productGroupsData : this.productGroups
        }
    },

    methods: {
        deleteGroup(productGroup) {
            axios.delete(route('admin.product-groups.destroy', productGroup.id))
            .then( res => {
                this.productGroupsData = this.productGroupsData.filter( productGroupData => productGroupData.id !== productGroup.id)
            })
        }
    }
}
</script>

<style scoped></style>