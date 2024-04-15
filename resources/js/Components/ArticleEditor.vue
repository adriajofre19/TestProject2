<script setup>
import StarterKit from "@tiptap/starter-kit";
import Underline from "@tiptap/extension-underline";
import { EditorContent, useEditor } from "@tiptap/vue-3";
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import SaveButton from "./SaveButton.vue";
import {defineProps} from 'vue';

const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
});

console.log(props.course);



let toggle = false;
let debug = false;

const form = useForm({
    title: "",
    content: "",
    descripcio: props.course.descripcio,
});



const editor = useEditor({
    extensions: [StarterKit, Underline],
});

const save = () => {
    form.content = editor.value.getHTML();
};

const update = (d) => {
    data.title = d.value;
};

const setBold = () => {
    editor.value.chain().focus().toggleBold().run();
};

const setUnderline = () => {
    editor.value.chain().focus().toggleUnderline().run();
};

const setItalic = () => {
    editor.value.chain().focus().toggleItalic().run();
};

const onSubmit = () => {
    save();
    form.visibility = toggle;
    form.post(route("notes.create"));
};
</script>

<template>

            <form @submit.prevent="onSubmit">
                
                <div class="flex flex-col sm:flex-row gap-2">
                    <!-- EDITOR -->
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

                            <editor-content :editor="editor" v-model="form.descripcio" class="m-4" required/>
                        </div>
                    </div>
                    

                </div>
                <SaveButton class="my-4">Crear Notes</SaveButton>
            </form>
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