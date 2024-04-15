<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NoAuthLayout from '@/Layouts/NoAuthLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});



</script>

<template>
    <NoAuthLayout>
        
    </NoAuthLayout>
    
</template>
