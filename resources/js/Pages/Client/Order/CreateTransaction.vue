<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <div class="mb-4">
                <div v-for="cart in order.carts" :key="cart" class="mb-2">
                    {{ cart.product_title }} x {{ cart.qty }} = {{ cart.total_sum }}
                </div>
            </div>
            <div class="text-right">
                <div class="mb-4">Total: {{ this.$page.props.auth.user.carts_total_sum }}</div>
                <div>
           <!--         <Link 
                   :href="route('client.orders.transactions.store', order.id)"
                     method="post"
                        class="inline-block py-2 px-3 bg-indigo-800 border border-indigo-900 text-center text-white">
                    Pay</Link>-->
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';

export default {
    name: "CreateTransaction",
    layout: MainLayout,

    props: {
        order: Object
    },

    components: {
        Link
    },
}
</script>

<style scoped></style>