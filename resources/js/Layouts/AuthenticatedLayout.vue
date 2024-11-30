<template>
    <div
        :class="[
            'fixed left-0 transition-all duration-300',
            useStorage ? 'w-[calc(100%_-_300px)]' : 'w-full',
        ]"
        class="fixed left-0"
    >
        <Teleport v-if="showModal == true" to="body">
            <Modal2 @closeModal="showModal = false">
                <template #content>
                    <Link
                        :href="route('profile.edit')"
                        class="h-8 px-4 flex items-center cursor-pointer m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-950 rounded-lg focus:shadow-outline"
                        type="button"
                        as="button"
                        :preserve-state="false"
                    >
                        Profile
                    </Link>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="h-8 px-4 m-2 flex items-center cursor-pointer text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                    >
                        Log Out
                    </Link>
                </template>
            </Modal2>
        </Teleport>
        <div>
            <transition
                enter-active-class="transition-transform duration-300 ease"
                leave-active-class="transition-transform duration-300 ease"
                enter-from-class="translate-x-full"
                leave-to-class="translate-x-full"
            >
                <div v-if="useStorage" class="fixed top-0 right-0">
                    <SideBar :menu="menu"></SideBar>
                </div>
            </transition>
            <div class="min-h-screen bg-gray-100 dark:text-white dark:bg-black">
                <nav
                    class="border-b border-gray-100 bg-white dark:bg-black dark:text-white"
                >
                    <!-- Primary Navigation Menu -->
                    <div
                        class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 dark:text-white"
                    >
                        <div class="flex h-16 justify-between dark:text-white">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="flex shrink-0 items-center">
                                    <Bars3Icon
                                        @click="
                                            () => {
                                                useStorage = !useStorage;
                                            }
                                        "
                                        class="size-8 cursor-pointer"
                                    ></Bars3Icon>
                                </div>
                            </div>

                            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                                <div class="flex shrink-0 items-left m-l-5">
                                    <button
                                        class="text-black dark:text-white"
                                        @click="toggleDark()"
                                    >
                                        <span v-if="isDark == false">
                                            <SunIcon class="size-5"></SunIcon>
                                        </span>
                                        <span v-if="isDark == true">
                                            <MoonIcon class="size-5"></MoonIcon>
                                        </span>
                                    </button>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="relative ms-3">
                                    <div align="right" width="48">
                                        <span class="inline-flex rounded-md">
                                            <div
                                                class="inline-flex cursor-pointer items-center rounded-md border border-transparent px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                                type="button"
                                                as="button"
                                                @click="runModal()"
                                            >
                                                <UserCircleIcon
                                                    class="size-7"
                                                ></UserCircleIcon>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{
                            block: showingNavigationDropdown,
                            hidden: !showingNavigationDropdown,
                        }"
                        class="sm:hidden"
                    >
                        <div class="space-y-1 pb-3 pt-2">
                            <ResponsiveNavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { useDark, useToggle, useLocalStorage } from "@vueuse/core";
import Modal2 from "../Components/Modal2.vue";
import SideBar from "@/Components/SideBar.vue";

const showingNavigationDropdown = ref(false);

const isDark = useDark();
const toggleDark = useToggle(isDark);

const showModal = ref(false);
function runModal() {
    showModal.value = true;
}

const menu = ref(usePage().props.menu);

const useStorage = useLocalStorage("SideBarValue", true);

import {
    MoonIcon,
    SunIcon,
    UserIcon,
    UserCircleIcon,
    Bars3Icon,
} from "@heroicons/vue/24/solid";
</script>
