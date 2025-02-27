<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.create')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Add</Link>
        </div>
        <div>
            <table class="table-auto w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                        <th class="border border-gray-300 px-4 py-2">Products</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="product in productsData">
                        <ProductItem @product_children_got="updateProductChildrenData" @product_deleted="updateProductData" :product="product"></ProductItem>
                        <template v-if="product.productChild" v-for="productChild in product.productChild">
                            <ProductItem @product_deleted="updateProductChildrenData" :product="productChild" :isChild="true"></ProductItem>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductItem from '@/Components/Admin/Product/ProductItem.vue'
import { Link } from '@inertiajs/vue3';

export default {
    name: "Index",
    layout: AdminLayout,
    components: {
        Link,
        ProductItem
    },

    props: {
        products: Array
    },

    data() {
        return {
            productChildrenData: [],
            productsData: this.products
        }
    },

    methods: {
        updateProductData(product) {
            this.productsData = this.productsData.filter(productData => productData.id !== product.id)
        },
    }
}
</script>

<style scoped></style>