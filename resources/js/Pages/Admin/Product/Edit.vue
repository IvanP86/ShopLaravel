<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Products</Link>
        </div>
        <div v-if="success" class="mb-4 p-4 bg-green-100">
            Save was success !
        </div>        
        <div>
          <div class="mb-4">
                <input type="text" v-model="entries.product.title" class="border border-gray-200 p-2 w-1/4"
                    placeholder="title">
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.description" class="border border-gray-200 p-2 w-1/4"
                    placeholder="description"></textarea>
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.content" class="border border-gray-200 p-2 w-1/4"
                    placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.price" class="border border-gray-200 p-2 w-1/4"
                    placeholder="price">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.old_price" class="border border-gray-200 p-2 w-1/4"
                    placeholder="old_price">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.qty" class="border border-gray-200 p-2 w-1/4"
                    placeholder="quantity">
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="entries.product.category_id">
                    <option value="null" disabled selected>Choose category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="entries.product.product_group_id">
                    <option value="null" disabled selected>Choose group</option>
                    <option v-for="productGroup in productGroups" :value="productGroup.id">{{ productGroup.title }}</option>
                </select>
            </div>
<!--            <div class="mb-4">
                <input type="file" v-model="entries.images" class="border border-gray-200 p-2 w-1/4">
            </div>-->
<!--            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="entries.product.group_id">
                    <option value="null" disabled selected>Choose group</option>
                    <option v-for="productGroup in productGroups" :value="productGroup.id">{{ productGroup.title }}</option>
                </select>
            </div>-->
            <div class="mb-4">
                <a @click.prevent="updateProduct"
                    class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white" href="#">Save</a>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: "Edit",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        categories: Array,
        productGroups: Array,
        product: Object
    },
    data() {
        return {
            success: false,
            entries: {
                product: this.product
                // images: null,
                // params: []
            }
        }
    },

    methods: {
        updateProduct() {
            axios.patch(route('admin.products.update', this.product.id), this.entries)
                .then(res => {
                    this.success = true
                })
        }
    }
}
</script>

<style scoped></style>