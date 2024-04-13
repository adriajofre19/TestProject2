<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Carousel from '@/Components/Carousel.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { defineProps } from 'vue';
import ArticleEditor from '@/Components/ArticleEditor.vue';
import Banner from '@/Components/Banner.vue';

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
                Inici
            </h2>
        </div>

        <Banner />

        
        <div class="pl-16 pr-16 mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-8">
                Crear notes
            </h2>
        
            <ArticleEditor />
        
    </div>


    </AuthenticatedLayout>

</template>