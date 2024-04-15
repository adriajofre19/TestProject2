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
import StarterKit from "@tiptap/starter-kit";
import Underline from "@tiptap/extension-underline";
import { EditorContent, useEditor } from "@tiptap/vue-3";

const showDropdown = ref(false);
const editingcourse = ref(false);
const confirmingAdminDeletion = ref(false);
const courseToDelete = ref({});

const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: '',
    nom: '',
    descripcio: '',
    actiu: '',

});

function openEditModal(id) {
    editingcourse.value = true;
    form.id = id;
    form.nom = props.course.nom;
    form.descripcio = editor.value.getHTML();
    form.actiu = props.course.actiu;
    
}

function confirmAdminDeletion(id, nom) {
    confirmingAdminDeletion.value = true;
    courseToDelete.value = {
        id: id,
        nom: nom,
    };
}

const closeModal = () => {
    confirmingAdminDeletion.value = false;
    editingcourse.value = false;
    showDropdown.value = false;
};

function deleteAdmin(id) {
    confirmingAdminDeletion.value = false;
    showDropdown.value = false;
    router.post(route('curse.destroy', id));
}

const save = () => {
    form.content = editor.value.getHTML();
};


function update() {
    save();
    editingcourse.value = false;
    showDropdown.value = false;
    form.content = editor.value.getHTML();
    form.post(route('curse.update', form.id));
}

const handleDropdownClick = () => {
    showDropdown.value = !showDropdown.value;
}

function setState(num) {
    if (num == 1) {
        return 'Actiu'
    } else {
        return 'Inactiu'
    
    }

}




const editor = useEditor({
    extensions: [StarterKit, Underline],
    content: props.course.descripcio,
});

const setBold = () => {
    editor.value.chain().focus().toggleBold().run();
};

const setUnderline = () => {
    editor.value.chain().focus().toggleUnderline().run();
};

const setItalic = () => {
    editor.value.chain().focus().toggleItalic().run();
};


</script>

<template>
    
    <div class="relative flex flex-col justify-items-center items-center p-4 pb-4 pt-0 w-full">
        <div class="bg-white border-red border rounded-md px-4 py-3 w-full relative" role="comment">
            <div class="absolute top-0 right-0 sm:float-right p-2">
                <div class="relative">
                    <button :id="'dropdownMenuIconButton_' + course.id"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                        type="button" aria-label="Opciones" @click="handleDropdownClick(course.id)">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 4 15">
                            <path
                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </button>
                    <div :class="{ 'hidden': !showDropdown }"
                        class="absolute top-full right-0 mt-2 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-36 sm:w-44">
                        <ul class="py-2 text-xs sm:text-sm text-gray-700"
                            :aria-labelledby="'dropdownMenuIconButton_' + course.id">
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button" @click="openEditModal(course.id)" title="No validat">
                                    Editar
                                </div>
                            </li>
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button"
                                    @click="confirmAdminDeletion(course.id, course.nom)">
                                    Eliminar
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-2">
                <div class="sm:ml-8">
                    <span class="text-sm font-bold">{{ course.nom }}</span>
                    <div v-html="course.descripcio"></div>
                    <p v-if="course.actiu === 1" class="cursor-default mt-1 text-sm text-blue-600">{{ setState(course.actiu) }}</p>
                    <p v-else class="cursor-default mt-1 text-sm text-red-600">{{ setState(course.actiu)  }} </p>
                    
                </div>
            </div>
        </div>
    </div>

    <Modal :show="confirmingAdminDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 inline-block mb-2">
                Estàs segur que vols eliminar el curs:
                <p class="inline-block text-red">{{ courseToDelete.nom }}</p>
            </h2>
            
            <div class="mt-6 flex justify-end">
                <PrimaryButton @click="closeModal" class="text-sm">Cancel·lar</PrimaryButton>
                <DangerButton class="ml-3 text-sm" @click="deleteAdmin(courseToDelete.id)">
                    Eliminar
                </DangerButton>
            </div>
        </div>
    </Modal>

    <Modal :show="editingcourse" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 mb-4 flex justify-center items-center">
                <span>Edició d'usuari:</span>
                <span class="text-red ml-1">{{ form.name }}</span>
            </h2>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Nom del curs</label>
                <input type="text" v-model="form.nom"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Descripció del curs</label>
                <input type="email" v-model="form.descripcio" readonly
                    class="text-sm bg-gray-200 text-gray-600 opacity-50 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>

            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Descripció del curs</label>


                <div class="flex-1 flex flex-col">
                        
                        <!-- Toolbar TODO: Leave highlighted if activated -->
                        <div class="border-container bg-white">
                            <!-- TODO: Unhide until articles shows plain html -->
                            <div class="border-container-bottom mb-2 h-10 flex flex-row items-centers">
                                <button class="toolbar-btn font-bold" type="button" @click="setBold">
                                    B
                                </button>
                                <button class="toolbar-btn italic" type="button" @click="setItalic">
                                    K
                                </button>
                                <button class="toolbar-btn underline" type="button" @click="setUnderline">
                                    U
                                </button>
                            </div>

                            <editor-content :editor="editor" v-model="props.course.descripcio" class="m-4"/>
                        </div>
                    </div>



            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Estat</label>
                <select v-model="form.actiu"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
                    <option value="1">Actiu</option>
                    <option value="0">Desactivat</option>
                </select>
            </div>
            <div class="mt-6 flex justify-end">
                <DangerButton @click="closeModal" class="text-sm">Cancel·lar</DangerButton>
                <PrimaryButton @click="update" class="ml-3 bg-red hover:bg-red text-sm">Guardar</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<style lang="postcss">
.toolbar-btn {
    @apply duration-100 ease-in-out hover:bg-black hover:text-white active:bg-black active:text-white w-10 h-10 mr-1;
}

textarea {
    @apply rounded-md border-transparent focus:border-transparent focus:ring-0;
    width: 100%;
    height: 100%;
    resize: none;
}

textarea:focus {
    outline: none;
}

.ProseMirror {
    min-height: 300px;
    max-height: 500px;
    overflow: auto;
}

.ProseMirror:focus {
    outline: none;
}

.border-container {
    @apply border border-gray-600 rounded-md;
}

.border-container-bottom {
    @apply border border-gray-600 border-x-0 border-t-0;
}

@media (min-width: 640px) {
    #attributes-selector {
        @apply w-64;
    }
}
</style>