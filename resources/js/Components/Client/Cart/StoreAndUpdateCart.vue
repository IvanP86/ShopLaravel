<template>
    <div>
        <div v-if="cartId" class="text-center">
            <a @click.prevent="cart.qty > 1 ? cart.qty-- : ''; updateCart()" href="#"
                class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">-</a>
            <input min="1" type="number" v-model="cart.qty" class="p-2 border border-gray-200" placeholder="Quantity"
                value="1" disabled>
            <a @click.prevent="cart.qty++; updateCart()" href="#"
                class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">+</a>
        </div>
        <a v-if="!cartId" @click.prevent="storeCart" href="#"
            class="block py-2 bg-indigo-800 border border-indigo-900 text-center text-white">Buy</a>
    </div>
</template>

<script>
export default {
    name: "StoreAndUpdateCart",

    props: {
        product: Object
    },
    data() {
        return {
            cart: {
                qty: 1,
                product_id: this.product.id
            },
            cartId: null,
        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then(res => {
                    this.cartId = res.data.id
                })
        },
        updateCart() {
            axios.patch(route('client.carts.update', this.cartId), this.cart)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>

<style scoped></style>