<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ArticleEditor from '@/Components/ArticleEditor.vue';
import { Head } from "@inertiajs/vue3";
</script>

<template>

    <Head title="Crear article" />

    <AuthenticatedLayout>

        <div class=" bg-white p-8 border-b border-gray-300">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear una nota
            </h2>
        </div>

        
            <div class="p-4">
                <ArticleEditor />
            </div>
        
    </AuthenticatedLayout>
</template>
