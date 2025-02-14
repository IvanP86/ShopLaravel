<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Params</Link>
        </div>
        <div v-if="success" class="mb-4 p-4 bg-green-100">
            Save was success !
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="param.title" class="border border-gray-200 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="param.filter_type">
                    <option value="null" disabled selected>Choose filter type</option>
                    <option v-for="filterType in filterTypes" :value="filterType.value">{{ filterType.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <a @click.prevent="updateParam"
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
        param: Object,
        filterTypes: Array
    },

    data() {
        return {
            success: false
        }
    },

    methods: {
        updateParam() {
            axios.patch(route('admin.params.update', this.param), this.param)
                .then(res => {
                    this.success = true
                })
        }
    },
    watch: {
        param: {
            handler(new_val, old_val) {
                this.success = false
            }, 
            deep: true

        }
    }
}
</script>

<style scoped></style>