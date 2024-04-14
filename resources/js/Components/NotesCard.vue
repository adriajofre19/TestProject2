<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    note: {
        type: Object,
        required: true
    }
});

console.log(props.note);

</script>

<template>
    <div class="bg-white p-8 border border-gray-300">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ note.title }}
        </h2>

        
        
        <div v-html="note.content"></div>
    </div>

    


    




</template>