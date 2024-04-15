<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    course: {
        type: Object,
        required: true
    },
    contents: {
        type: Object,
        required: true
    }
});

console.log(props.course);
console.log(props.contents);

</script>

<template>
    <AuthenticatedLayout>

    <div class="bg-white border border-gray-200 hover:bg-gray-100 cursor-pointer">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ props.course.nom }}</h5>
        <p class="font-normal text-gray-700 ">{{ props.course.descripcio }}</p>
    </div>

    <div v-for="content in props.contents" :key="content.id">
        
        <a class="block mw-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ content.title }}</h5>
        <p class="font-normal text-gray-700 ">{{ content.description }}</p>
        </a>


    </div>

</AuthenticatedLayout>



</template>