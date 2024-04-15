<script setup>
import { ref } from 'vue';
import {defineProps} from 'vue';
import ContentCard from '@/Components/ContentCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import ArticleEditor from '@/Components/ArticleEditor.vue';

const addcontent = ref(false);

function openAddContent() {
    addcontent.value = true;
}

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

        <div class=" bg-white p-8 border-b border-gray-300">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contingut
            </h2>
            <button @click="openAddContent" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Afegir contingut</button>
        </div>


    <ContentCard v-for="content in contents" :key="content.id" :content="content" />
    </AuthenticatedLayout>

    <Modal :show="addcontent" @close="closeModal">
        <ArticleEditor />
    
    </Modal>
</template>