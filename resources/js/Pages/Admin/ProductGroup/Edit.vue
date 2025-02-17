<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Product Groups</Link>
        </div>
        <div v-if="success" class="mb-4 p-4 bg-green-100">
            Save was success !
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="productGroup.title" class="border border-gray-200 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <a @click.prevent="updateProductGroup"
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
        productGroup: Object,
    },

    data() {
        return {
            success: false
        }
    },

    methods: {
        updateProductGroup() {
            axios.patch(route('admin.product-groups.update', this.productGroup), this.productGroup)
                .then(res => {
                    this.success = true
                })
        }
    },
    watch: {
        productGroup: {
            handler(new_val, old_val) {
                this.success = false
            }, 
            deep: true

        }
    }
}
</script>

<style scoped></style>