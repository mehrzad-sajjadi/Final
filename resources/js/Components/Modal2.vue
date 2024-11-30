<template>
    <div
        class="fixed top-0 right-0 left-0 bottom-0 bg-[#0d09089c] p-10 content-center"
    >
        <div ref="checkOut" class="rounded-md m-auto bg-white w-2/3">
            <XMarkIcon
                @click="emit('closeModal')"
                as="button"
                type="button"
                class="size-5 cursor-pointer"
            />
            <div class="flex justify-center py-4">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onClickOutside } from "@vueuse/core";
import { ref } from "vue";
const emit = defineEmits("closeModal");
const checkOut = ref(null);
onClickOutside(checkOut, () => {
    emit("closeModal");
});

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
    ClipboardDocumentListIcon,
    HandThumbDownIcon,
    CheckBadgeIcon,
    UserPlusIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
</script>
