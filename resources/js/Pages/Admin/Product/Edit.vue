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
            <div class="mb-4">
                <input @change="setImages" type="file" multiple class="border border-gray-200 p-2 w-1/4">
            </div>
            <div class="mb-4">
                <div class="grid grid-cols-3 gap-x-4 ">
                    <div v-for="image in product.images">
                        <img :src="image.url" alt="product.title" class="mb-2">
                        <div class="text-center">
                            <a @click.prevent="deleteImage(image)" href="#" class="inline-block px-2 py-1 text-sm bg-red-800 text-gray-200 border border-red-900" >Delete</a>
                        </div>
                    </div>
                </div>
            </div>
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
                product: this.product,
                images: null,
                _method: 'patch',
                // params: []
            }
        }
    },

    methods: {
        updateProduct() {
            axios.post(route('admin.products.update', this.product.id), this.entries, {
                headers: {
                    "Content-Type" : "multipart/form-data"
                }
            })
                .then(res => {
                    this.product.images = res.data.images
                    this.success = true
                })
        },
        deleteImage(image){
            axios.delete(route('admin.images.destroy', image.id))
            .then(res => {
                this.product.images = this.product.images.filter(productImage => productImage.id !== image.id)
            })
        },
        setImages(e) {
            this.entries.images = e.target.files
        }
    }
}
</script>

<style scoped></style>