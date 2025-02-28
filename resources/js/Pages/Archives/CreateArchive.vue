<template>

    <AuthenticatedLayout>
        <div>
            <SectionHead title="Ajouter un nouveau document" />

            <div class="m-4 flex gap-2 justify-center">
                <div>
                    <form @submit.prevent="submit" class="max-w-[600px] space-y-4 mx-4 border p-4 rounded-sm" enctype="multipart/form-data">
                        <div class="w-full">
                            <label for="title">Titre du document</label>
                            <div>
                                <Input 
                                    v-model="fileForm.title" 
                                    name="title" 
                                    id="title"
                                    class="w-full focus:ring-1 rounded-sm" placeholder="Rapport de fin d'année"/>
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="type">Type de document</label>
                            <div>
                                <Input 
                                    v-model="fileForm.type" 
                                    name="type" 
                                    id="type"
                                    class="w-full focus:ring-1 rounded-sm" placeholder="rapport, lettre, note..."/>
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="content">Contexte ou description</label>
                            <div>
                                <textarea 
                                    v-model="fileForm.content" 
                                    name="content" id="content"
                                    class="w-full field-sizing-content focus:ring-1 rounded-sm resize-y"
                                    placeholder="Un résumé ou une brève description du contenu et de la finalité du document"></textarea>
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="content">Ranger dans le dossier:</label>
                            <div class="w-full">
                                <select
                                class="rounded-sm outline-none focus:outline-none border-slate-200 w-full"
                                >
                                    <option value="Site ATTINGUIE">
                                        Entrepôt ATTINGUIE (8)
                                    </option>
                                    <option value="usine Daloa">
                                        Usine Daloa (4)
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="file">Fichier à téléverser</label>
                            <div class="flex justify-between items-center">
                                <Input @change="loadFile" type="file" name="file" id="file"
                                    accept="/image/*, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt"
                                    class="w-2/3 focus:ring-1 rounded bg-black text-white py-2 px-2 border-none"/>
                                <button 
                                    class="w-1/3flex justify-center"
                                    >
                                    <Trash class="stroke-red-600"/>
                                </button>
                            </div>
                        </div>
                        <div class="w-full">
                            <input 
                                type="submit"
                                class="w-full p-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded mt-4 transition-colors"
                                value="Enregistrer"
                            >
                        </div>

                    </form>
                </div>

                <div class="flex justify-center items-center border border-solid rounded-sm h-[525px] w-[400px]">
                    <embed class=" w-full h-full p-2 rounded-sm border" src="/archives/preview.pdf"></embed>
                </div>

                <!-- size-[350px] if file extension isn't PDF -->

            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SectionHead from '@/Components/SectionHead.vue';
import Note from '@/Components/Note.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Input from "@/Components/forms/Input.vue"
import { Trash } from 'lucide-vue-next';

const fileForm = useForm({
    title: null,
    type: null,
    content: null,
    tags: null,
    category: null,
    file: null

})

const loadFile = (e) => {
    fileForm.file = e.target.files[0]
    fileForm.post(usePage().url)
}

</script>

<style scoped>
form {
    margin: 0 auto;
}

input,
textarea,
select {
    border: 1.2px solid #94a3b8 ;
}

</style>