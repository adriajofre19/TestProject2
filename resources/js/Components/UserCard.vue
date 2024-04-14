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

const showDropdown = ref(false);
const editingUser = ref(false);
const confirmingAdminDeletion = ref(false);
const userToDelete = ref({});

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: '',
    name: '',
    email: '',
    role: '',
    password: '',
});

function openEditModal(id) {
    editingUser.value = true;
    form.id = id;
    form.name = props.user.name;
    form.email = props.user.email;
    form.role = props.user.role;
    form.password = props.user.password;
}

function confirmAdminDeletion(id, name, email, role) {
    confirmingAdminDeletion.value = true;
    userToDelete.value = {
        id: id,
        name: name,
        email: email,
        role: role,
    };
}

const closeModal = () => {
    confirmingAdminDeletion.value = false;
    editingUser.value = false;
    showDropdown.value = false;
};

function deleteAdmin(id) {
    confirmingAdminDeletion.value = false;
    showDropdown.value = false;
    router.post(route('users.destroy', id));
}

function update() {
    editingUser.value = false;
    showDropdown.value = false;
    form.post(route('users.update', form.id));
}

const handleDropdownClick = () => {
    showDropdown.value = !showDropdown.value;
}

function getInitials(name) {
    let name2 = name.split(' ').map((n) => n[0]).join('');
    return name2.substring(0, 2);
}

</script>

<template>
    <div class="relative flex flex-col justify-items-center items-center p-4 pb-4 pt-0 ">
        <div class="bg-white border-red border rounded-md px-4 py-3 w-full relative" role="comment">
            <div class="absolute top-0 right-0 sm:float-right p-2">
                <div class="relative">
                    <button :id="'dropdownMenuIconButton_' + user.id"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                        type="button" aria-label="Opciones" @click="handleDropdownClick(user.id)">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 4 15">
                            <path
                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </button>
                    <div :class="{ 'hidden': !showDropdown }"
                        class="absolute top-full right-0 mt-2 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-36 sm:w-44">
                        <ul class="py-2 text-xs sm:text-sm text-gray-700"
                            :aria-labelledby="'dropdownMenuIconButton_' + user.id">
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button" @click="openEditModal(user.id)" title="No validat">
                                    Editar
                                </div>
                            </li>
                            <li>
                                <div
                                    class="block px-3 sm:px-4 py-2 hover:bg-gray-100 w-full text-left cursor-pointer"
                                    type="button"
                                    @click="confirmAdminDeletion(user.id, user.name, user.email, user.role)">
                                    Eliminar
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-2">
                <div class="flex items-center justify-center w-16 h-16 bg-gray-300 rounded-full mr-8 sm:mr-0">
                        <span class="text-xl font-medium text-gray-900">{{ getInitials(user.name) }}</span>
                </div>
                <div class="sm:ml-8">
                    <span class="text-sm font-bold">{{ user.name }}</span>
                    <p class="cursor-default mt-1 text-sm text-gray-500">{{ user.email }}</p>
                    <p class="cursor-default mt-1 text-sm">{{ user.role }}</p>
                </div>
            </div>
        </div>
    </div>

    <Modal :show="confirmingAdminDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 inline-block mb-2">
                Estàs segur que vols eliminar l'usuari:
                <p class="inline-block text-red">{{ userToDelete.name }}</p>
            </h2>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Nom d'usuari: </span> {{ userToDelete.name }}</p>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Correu electrònic: </span> {{ userToDelete.email }}
            </p>
            <p class="mb-2 text-sm"><span class="font-bold text-sm">Rol d'usuari: </span> {{ userToDelete.role }}</p>
            <div class="mt-6 flex justify-end">
                <PrimaryButton @click="closeModal" class="text-sm">Cancel·lar</PrimaryButton>
                <DangerButton class="ml-3 text-sm" @click="deleteAdmin(userToDelete.id)">
                    Eliminar
                </DangerButton>
            </div>
        </div>
    </Modal>

    <Modal :show="editingUser" @close="closeModal">
        <div class="p-6">
            <h2 class="text-sm font-bold text-gray-900 mb-4 flex justify-center items-center">
                <span>Edició d'usuari:</span>
                <span class="text-red ml-1">{{ form.name }}</span>
            </h2>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Nom d'usuari</label>
                <input type="text" v-model="form.name"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Correu electrònic</label>
                <input type="email" v-model="form.email" readonly
                    class="text-sm bg-gray-200 text-gray-600 opacity-50 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Contrasenya</label>
                <input type="password" v-model="form.password"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-900 text-sm">Rol d'usuari</label>
                <select v-model="form.role"
                    class="text-sm mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red focus:border-red">
                    <option value="admin">Administrador</option>
                    <option value="user">Usuari</option>
                </select>
            </div>
            <div class="mt-6 flex justify-end">
                <DangerButton @click="closeModal" class="text-sm">Cancel·lar</DangerButton>
                <PrimaryButton @click="update" class="ml-3 bg-red hover:bg-red text-sm">Guardar</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>