<script setup>
import { ref } from 'vue';
import {defineProps} from 'vue';
import ContentCard from '@/Components/ContentCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    contents: {
        type: Object,
        required: true
    }
});
console.log(props.contents);
</script>
<template>
    <AuthenticatedLayout>
    <ContentCard v-for="content in contents" :key="content.id" :content="content" />
    </AuthenticatedLayout>
</template>