<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    course: {
        type: Object,
        required: true
    }
});

function limitDescription(description) {
    return description.length > 150 ? description.substring(0, 150) + '...' : description;
}
</script>
<template>
<a :href="'/courses/'+course.id" class="block w-full p-6 bg-white border border-gray-200 hover:bg-gray-100 cursor-pointer">

    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ course.nom }}</h5>
    <p class="font-normal text-gray-700 ">{{ limitDescription(course.descripcio) }}</p>
    </a>
</template>
    