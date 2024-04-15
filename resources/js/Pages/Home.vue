<script setup>
import Carousel from '@/Components/Carousel.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { defineProps } from 'vue';
import ArticleEditor from '@/Components/ArticleEditor.vue';
import Banner from '@/Components/Banner.vue';
import NoAuthLayout from '@/Layouts/NoAuthLayout.vue';
import CourseCard from '@/Components/CourseCard.vue';
import Menu from '@/Components/Menu.vue';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

onMounted(() => {
    initFlowbite();
});

const cookiesModal = ref(true);

function closeCookies() {
    cookiesModal.value = false;
}

const props = defineProps({
    auth: {
        type: Object,
        required: true
    },
    courses: {
        type: Array,
        required: true
    }
});


</script>

<template>

    <div v-if="props.auth.user != null">

    <AuthenticatedLayout>

        <Menu>

            <Banner />

            <CourseCard v-for="course in courses" :key="course.id" :course="course" />



        </Menu>

    </AuthenticatedLayout>
    

    

</div>

<div v-else>

    <NoAuthLayout>

        <Menu :course="courses">

            <Banner />

            <CourseCard v-for="course in courses" :key="course.id" :course="course" />

        </Menu>

    </NoAuthLayout>

    <section v-if="cookiesModal === true" class="fixed max-w-md p-4 mx-auto bg-white border border-gray-200  right-12 bottom-16 rounded-2xl z-10">
    <h2 class="font-semibold text-gray-800">🍪 Utilitzem cookies</h2>

    <p class="mt-4 text-sm text-gray-600 ">Hola, aquest lloc web utilitza cookies per oferir una experiència d'usari més personalitzada. <a href="#" class="font-medium text-gray-700 underline transition-colors duration-300 hover:text-blue-500">Llegir més</a>. </p>
    
    <p class="mt-3 text-sm text-gray-600 ">Tancar aquesta finestra modal guardarà les configuracions per defecte.</p>
    
    <div class="grid grid-cols-2 gap-4 mt-4 shrink-0">
        <button @click="closeCookies()" class=" text-xs bg-gray-900 font-medium rounded-lg hover:bg-gray-700 text-white px-4 py-2.5 duration-300 transition-colors focus:outline-none">
            Acceptar
        </button>

        <button @click="closeCookies()" class=" text-xs border text-gray-800 hover:bg-gray-100  font-medium rounded-lg px-4 py-2.5 duration-300 transition-colors focus:outline-none">
            Rebutjar
        </button>
    </div>
</section>

</div>

</template>