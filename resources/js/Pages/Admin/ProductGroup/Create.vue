<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Product Groups</Link>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="productGroup.title" class="border border-gray-200 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <a @click.prevent="storeProductGroup"
                    class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white" href="#">Create</a>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: "Create",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        filterTypes: Array
    },
    data() {
        return {
            productGroup: {}
        }
    },

    methods: {
        storeProductGroup() {
            axios.post(route('admin.product-groups.store'), this.productGroup)
                .then(res => {
                    this.productGroup = {}
                })
        }
    }
}
</script>

<style scoped></style>