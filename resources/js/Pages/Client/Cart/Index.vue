<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <template v-if="this.$page.props.auth.user.carts_total_sum > 0">
                <div class="mb-4">
                    <table class="table-auto w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Title</th>
                                <th class="border border-gray-300 px-4 py-2">Image</th>
                                <th class="border border-gray-300 px-4 py-2">Quantity</th>
                                <th class="border border-gray-300 px-4 py-2">Sum</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cart in cartsData" :key="cart">
                                <td class="border border-gray-300 px-4 py-2">{{ cart.id }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <Link :href="route('client.products.show', cart.product_id)">{{ cart.product_title }}
                                    </Link>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <img class="w-24" :src="cart.product_image_url" :alt="cart.product_title">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div>
                                        <a @click.prevent="cart.qty > 1 ? cart.qty-- : ''; updateCart(cart)" href="#"
                                            class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">-</a>
                                        <input min="1" type="number" v-model="cart.qty"
                                            class="p-2 border w-1/4 border-gray-200" placeholder="Quantity" value="1"
                                            disabled>
                                        <a @click.prevent="cart.qty++; updateCart(cart)" href="#"
                                            class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">+</a>
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ cart.total_sum }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <svg @click="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-4 text-red-600 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>

                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <div class="mb-4">Total: {{ this.$page.props.auth.user.carts_total_sum }}</div>
                    <div>
                        <Link :href="route('client.orders.store')" method="post"
                            class="inline-block py-2 px-3 bg-indigo-800 border border-indigo-900 text-center text-white">
                        Order</Link>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="mb-4 bg-white border border-gray-200 p-4">
                    Cart is empty, you can add to cart from
                    <Link class="text-indigo-600" :href="route('client.categories.index')">Catalog</Link>
                </div>
            </template>
        </div>
    </article>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';

export default {
    name: "Index",
    layout: MainLayout,

    props: {
        carts: Array
    },

    components: {
        Link
    },

    data() {
        return {
            cartsData: this.carts
        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then(res => {
                    this.cartId = res.data.id
                })
        },
        updateCart(cart) {
            axios.patch(route('client.carts.update', cart.id), { qty: cart.qty })
                .then(res => {
                    this.$page.props.auth.user.carts_total_sum = this.$page.props.auth.user.carts_total_sum + res.data.total_sum - cart.total_sum
                    cart.total_sum = res.data.total_sum
                })
        },
        destroyCart(cart) {
            axios.delete(route('client.carts.destroy', cart.id))
                .then(res => {
                    this.cartsData = this.cartsData.filter(cartData => cartData.id !== cart.id)
                    this.$page.props.auth.user.carts_total_sum = this.$page.props.auth.user.carts_total_sum - cart.total_sum
                })
        }
    }
}
</script>

<style scoped></style>