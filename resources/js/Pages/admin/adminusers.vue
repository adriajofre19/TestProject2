
<script setup>
import { ref } from 'vue';
import { initFlowbite } from 'flowbite';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import SaveButton from '@/Components/SaveButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import UserCard from '../../Components/UserCard.vue';


onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    auth: {
        type: Object,
        required: true
    },
    users: {
        type: Array,
        required: true
    }
});

</script>

<template>

    <AuthenticatedLayout>

        
            <div class="mb-4 bg-white p-8 border-b border-gray-300">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestionar Usuaris
            </h2>
            </div>
        

        <UserCard v-for="user in users" :key="user.id" :user="user" />

    </AuthenticatedLayout>

</template>
