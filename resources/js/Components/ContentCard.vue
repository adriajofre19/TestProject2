<script setup>
/*
import ThirdButton from '@/Components/Shared/ThirdButton.vue';
import DangerButton from '@/Components/Welcome/DangerButton.vue'; */
import Modal from '@/Components/Modal.vue';
import { router, useForm } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import SaveButton from './SaveButton.vue';
import PrimaryButton from './PrimaryButton.vue';
import DangerButton from './DangerButton.vue';
import ArticleEditor from './ArticleEditor.vue';

const showDropdown = ref(false);
const editingcontent = ref(false);
const confirmingAdminDeletion = ref(false);
const contentToDelete = ref({});
const addcontent = ref(false);

const props = defineProps({
    content: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: '',
    title: '',
    description: '',
    visibility: '',
});

function openEditModal(id) {
    editingcontent.value = true;
    form.id = id;
    form.title = props.content.title;
    form.description = props.content.description;
    form.visibility = props.content.visibility;
}

function addContent() {
    addcontent.value = true;
}

function confirmAdminDeletion(id, title, description, visibility) {
    confirmingAdminDeletion.value = true;
    contentToDelete.value = {
        id: id,
        title: title,
        description: description,
        visibility: visibility,
    };
}

const closeModal = () => {
    confirmingAdminDeletion.value = false;
    editingcontent.value = false;
    showDropdown.value = false;
};

function deleteAdmin(id) {
    confirmingAdminDeletion.value = false;
    showDropdown.value = false;
    router.post(route('contents.destroy', id));
}

function update() {
    editingcontent.value = false;
    showDropdown.value = false;
    form.post(route('contents.update', form.id));
}

const handleDropdownClick = () => {
    showDropdown.value = !showDropdown.value;
}

</script>

<template>
    <div class="relative flex flex-col justify-items-center items-center p-4 pb-4 pt-0 ">
        <div class="bg-white border-red border rounded-md px-4 py-3 w-full relative" visibility="comment">
            <div class="absolute top-0 right-0 sm:float-right p-2">
                <div class="relative">
                    <button :id="'dropdownMenuIconButton_' + content.id"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                        type="button" aria-label="Opciones" @click="handleDropdownClick(content.id)">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 4 15">
                            <path
                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </button>
                    <div :class="{ 'hidden': !showDropdown }"
                        class="absolute top-full right-0 mt-2 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-36 sm:w-44">
                        <ul class="py-2 text-xs sm:text-sm text-gray-700"
                            :aria-labelledby="'dropdownMenuIconButton_' + content.id">
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button" @click="openEditModal(content.id)" title="No validat">
                                    Editar
                                </div>
                            </li>
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button"
                                    @click="confirmAdminDeletion(content.id, content.title, content.description, content.visibility)">
                                    Eliminar
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-2">
                <div class="sm:ml-8">
                    <span class="text-sm font-bold">{{ content.title }}</span>
                    <p class="cursor-default mt-1 text-sm text-gray-500">{{ content.description }}</p>
                    <p class="cursor-default mt-1 text-sm">{{ content.visibility }}</p>
                </div>
            </div>
        </div>
    </div>

    <Modal :show="confirmingAdminDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 inline-block mb-2">
                Estàs segur que vols eliminar l'usuari:
                <p class="inline-block text-red">{{ contentToDelete.title }}</p>
            </h2>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Nom d'usuari: </span> {{ contentToDelete.title }}</p>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Correu electrònic: </span> {{ contentToDelete.description }}
            </p>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Rol d'usuari: </span> {{ contentToDelete.visibility }}</p>
            <div class="mt-6 flex justify-end">
                <PrimaryButton @click="closeModal" class="text-sm">Cancel·lar</PrimaryButton>
                <DangerButton class="ml-3 text-sm" @click="deleteAdmin(contentToDelete.id)">
                    Eliminar
                </DangerButton>
            </div>
        </div>
    </Modal>

    <Modal :show="editingcontent" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 mb-4 flex justify-center items-center">
                <span>Edició d'usuari:</span>
                <span class="text-red ml-1">{{ form.title }}</span>
            </h2>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Nom d'usuari</label>
                <input type="text" v-model="form.title"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Correu electrònic</label>
                <input type="description" v-model="form.description" readonly
                    class="text-sm bg-gray-200 text-gray-600 opacity-50 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">visibilitat</label>
                <select v-model="form.visibility"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
                    <option value="true">Visible</option>
                    <option value="false">No visible</option>
                </select>
            </div>
            <div class="mt-6 flex justify-end">
                <DangerButton @click="closeModal" class="text-sm">Cancel·lar</DangerButton>
                <PrimaryButton @click="update" class="ml-3 bg-red hover:bg-red text-sm">Guardar</PrimaryButton>
            </div>
        </div>
    </Modal>

    
</template>