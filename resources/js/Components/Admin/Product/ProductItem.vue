<template>
    <tr>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-2']">{{ product.id }}</td>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-2']">
            <Link :href="route('admin.products.show', product.id)">{{ product.title }}</Link>
        </td>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-2']">{{ product.price }}</td>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-2']">{{ product.qty }}</td>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-3']">
            <div class="flex items-center">
                <!--<Link :href="route('admin.products.children.create', product.id)" class="mr-2">-->
                <Link v-if="!product.parent_id" :href="route('admin.products.replicate', product.id)" method="post" class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                </Link>
                <Link :href="route('admin.products.edit', product.id)" class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 cursor-pointer text-emerald-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                </Link>
                <svg @click.prevent="deleteProduct(product)" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 size-5 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>
        </td>
        <td :class="[product.parent_id ? 'bg-gray-100' : 'bg-white' , 'border border-gray-300 px-4 py-2']">
            <svg v-if="!product.parent_id && is_closed && product.has_children" @click="getProductChildren" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
            <svg v-if="!product.parent_id && !is_closed" @click="closeProductChildren" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>

        </td>
    </tr>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    name: "ProductItem",

    props: {
        product: Object,
    },

    components: {
        Link,
    },

    data() {

        return {
            is_closed: true
        }
    },
    methods: {
        deleteProduct(product) {
            axios.delete(route('admin.products.destroy', product.id))
                .then(res => {
                    this.$emit('product_deleted', product)
                })
        },
        getProductChildren() {
            axios.get(route('admin.products.children.index', this.product.id))
                .then(res => {
                    this.is_closed = false
                    this.product.children = res.data
                })
        },
        closeProductChildren() {
            this.is_closed = true
            this.product.children = null
        }
    }
}
</script>

<style scoped></style>