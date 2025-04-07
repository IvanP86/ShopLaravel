<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <BreadCrumbs :breadCrumbs="breadCrumbs" :title="product.title"></BreadCrumbs>
            <div class="flex items-start mb-4">
                <div class="flex mr-4 p-4 bg-white border border-gray-200 w-2/3">
                    <div style="width: 100px;" class="mr-4 w-1/3">
                        <div v-for="image in product.images" :key="image" class="mb-4">
                            <img class="cursor-pointer" @click="selectedImage = image" :src="image.url"
                                :alt="product.title">
                        </div>
                    </div>
                    <div v-if="selectedImage">
                        <img :src="selectedImage.url" :alt="product.title">
                    </div>
                </div>
                <div>
                    <div class="p-4 mb-4 bg-white border border-gray-200">
                        <div class="mb-4">
                            <h3 class="text-lg">{{ product.title }}</h3>
                        </div>
                        <div class="mb-4">
                            <span class="mr-4" :class="product.old_price ? 'text-red-600' : ''">{{ product.price }}</span>
                            <span v-if="product.old_price" class="line-through">{{ product.old_price }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ product.description }}</p>
                        </div>
                        <div v-if="paramProducts.length > 0" class="mb-4">
                            <div v-for="paramProduct in paramProducts" :key="paramProduct" class="mb-4 pb-4 border-b border-gray-200">
                                <div class="mb-4">
                                    <h3 class="text-lg">{{ paramProduct.title }}</h3>
                                </div>
                                <div>
                                    <Link v-for="paramItem in paramProduct.data" class="inline-block mr-2 p-2 border border-gray-600 border-rounded"
                                        :href="route('client.products.show', paramItem.product_id)" :key="paramItem">
                                    {{ paramItem.value }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="number" placeholder="Quantity" value="1">
                            <a href="#"
                                class="inline-block px-3 py-2 bg-indigo-800 border border-indigo-900 text-white">Buy</a>
                        </div>
                    </div>
                    <div v-if="product.group_products.length > 0" class="p-4 bg-white border border-gray-200">
                        <div class="mb-4">
                            <h3 class="text-lg">Another products</h3>
                        </div>
                        <div class="grid grid-cols-4 gap-4">
                            <Link v-for="groupProduct in product.group_products" :key="groupProduct"
                                :href="route('client.products.show', groupProduct.id)">
                            <img :src="groupProduct.preview_image_url" :alt="groupProduct.title">
                            <div class="text-sm text-center">
                                <div :class="groupProduct.old_price ? 'text-red-600' : ''">{{ groupProduct.price }}</div>
                                <div v-if="groupProduct.old_price" class="line-through">{{ groupProduct.old_price }}</div>
                            </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white border border-gray-200">
                <div class="mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-lg mb-2">Description!</h3>
                    <p>{{ product.content }}</p>
                </div>
                <div>
                    <h3 class="text-lg mb-2">Params</h3>
                    <div>
                        <div v-for="param in product.params" :key="param" class="flex items-center">
                            <div class="mr-2">
                                {{ param.title }} :
                            </div>
                            <div v-if="param.label === 'color'">
                                <span class="mr-2 inline-block border border-gray-400" v-for="value in param.values"
                                    :value="value" :key="value" :style="`background: ${value}; width:32px; heigh:16px`">
                                    &nbsp;
                                </span>
                            </div>
                            <div v-if="param.label !== 'color'">
                                <span v-for="value in param.values" :key="value">
                                    {{ value }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import BreadCrumbs from '@/Components/Client/Category/Breadcrumb.vue';


export default {
    name: "Show",
    layout: MainLayout,

    components: {
        Link,
        BreadCrumbs
    },

    props: {
        product: Object,
        breadCrumbs: Array,
        paramProducts: Array
    },

    data() {
        return {
            selectedImage: {
                url: this.product.preview_image_url
            }
        }
    }

}
</script>

<style scoped></style>