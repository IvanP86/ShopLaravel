<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Categories</Link>
        </div>
        <div v-if="success" class="mb-4 p-4 bg-green-100">
            Save was success !
        </div>        
        <div>
            <div class="mb-4">
                <input type="text" v-model="category.title" class="border border-gray-200 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="category.parent_id">
                    <option value="null" disabled selected>Choose category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <a @click.prevent="storeCategory"
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
        category: Object,
        categories: Array
    },

    data() {
        return {
            success: false
        }
    },

    methods: {
        storeCategory() {
            axios.patch(route('admin.categories.update', this.category), this.category)
                .then(res => {
                    this.success = true
                })
        }
    },
    watch: {
        category: {
            handler() {
                this.success = false
            },
            deep: true

        }
    }
}
</script>

<style scoped></style>