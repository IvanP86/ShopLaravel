<template>
    <section class="w-full p-4 border-b border-gray-100">
        <header>
            Market Admin
        </header>
    </section>
    <section class="flex">
        <slot/>

    </section>
    <section>
        <footer></footer>
    </section>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "MainLayout",
    components: {
        Link
    }
}

</script>

<stylt scoped>

</stylt>