<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { defineProps } from 'vue';
import NotesCard from '../Components/NotesCard.vue';

onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    auth: {
        type: Object,
        required: true
    },
    notes: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <AuthenticatedLayout>
        <div class=" bg-white p-8 border-b border-gray-300">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les meves notes
            </h2>
        </div>
        <div class="p-4">
            <NotesCard v-for="note in notes" :key="note.id" :note="note" />
        </div>
    </AuthenticatedLayout>
</template>