<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.index')"
                class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Params</Link>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="param.title" class="border border-gray-200 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 p-2 w-1/4" v-model="param.filter_type">
                    <option value="null" disabled selected>Choose  filter type</option>
                    <option  v-for="filterType in filterTypes" :value="filterType.value">{{ filterType.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <a @click.prevent="storeParam"
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
            param: {
                filter_type: null
            }
        }
    },

    methods: {
        storeParam() {
            axios.post(route('admin.params.store'), this.param)
                .then(res => {
                    this.param = {
                        filter_type : null
                    }
                })
        }
    }
}
</script>

<style scoped></style>