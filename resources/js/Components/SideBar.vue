<template>
    <div
        class="h-screen w-[300px] flex flex-col text-white text-center bg-gray-500 z-10"
    >
        <div
            class="w-full h-[50px] flex justify-center items-center bg-gray-900 text-center"
        >
            <Link
                :href="route('dashboard')"
                :active="route().current('dashboard')"
                :class="{
                    'text-blue-500 font-bold': route().current('dashboard'),
                    'text-gray-500': !route().current('dashboard'),
                }"
            >
                Dashboard
            </Link>
        </div>
        <div
            class="w-full h-[50px] flex justify-center items-center bg-gray-900 text-center"
            v-for="(item, index) in menu"
            :key="index"
        >
            <Link
                :href="route(item.route)"
                :active="item.active"
                :class="{
                    'text-blue-500 font-bold': item.active,
                }"
            >
                {{ item.name }}
            </Link>
        </div>
    </div>
</template>

<script setup>
import PrimeVue from "primevue/config";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    menu: Object,
});
</script>
