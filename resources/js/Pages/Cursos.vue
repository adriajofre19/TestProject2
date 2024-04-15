<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import CoursesAdminCard from '@/Components/CoursesAdminCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    courses: {
        type: Object,
        required: true
    }
});

console.log(props.courses);

</script>

<template>
    <AuthenticatedLayout>
        <CoursesAdminCard v-for="course in props.courses" :key="course.id" :course="course" />
    </AuthenticatedLayout>
    
</template>