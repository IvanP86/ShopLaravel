<template>
    <article class="w-3/4 bg-gray-50 p-4">
        <!--<div class="mb-4">
            <template v-for="breadcrumb in breadCrumbs" :key="breadcrumb">
                <Link :href="route('client.categories.products.index', breadcrumb.id)">
                {{ breadcrumb.title }}
                </Link>
                <span> / </span>
            </template>
            <span>{{ product.title }}</span>
        </div>-->
        <BreadCrumbs :breadCrumbs="breadCrumbs" :title="product.title"></BreadCrumbs>
        <div class="flex">
            <div class="flex mr-4">
                <div style="width: 100px;" class="mr-4">
                    <div v-for="image in product.images" :key="image" class="mb-4">
                        <img :src="image.url" :alt="product.title">
                    </div>
                </div>
                <div v-if="product.preview_image_url">
                    <img :src="product.preview_image_url" :alt="product.title">
                </div>
            </div>
            <div>
                <div>
                    <h3>{{ product.title }}</h3>
                </div>
                <div>
                    <span class="mr-4" :class="product.old_price ? 'text-red-600' : ''">{{ product.price }}</span>
                    <span v-if="product.old_price">{{ product.old_price }}</span>
                </div>
                <div>
                    <p>{{ product.description }}</p>
                </div>
                <div>
                    <input type="number" placeholder="Quantity" value="1">
                    <a href="#" class="inline-block px-3 py-2 bg-indigo-800 border border-indigo-900 text-white">Buy</a>
                </div>
            </div>
        </div>
        <div>
            <div>
                <h3>Description!</h3>
                <p>{{ product.content }}</p>
            </div>
            <div>
                <h3>Params</h3>
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
        breadCrumbs: Array
    }

}
</script>

<style scoped></style>