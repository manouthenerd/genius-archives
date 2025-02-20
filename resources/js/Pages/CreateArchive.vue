<template>

    <AuthenticatedLayout>
        <div>
            <SectionHead title="Ajouter un nouveau document" />

            <div class="m-4">
                <form @submit.prevent="submit" class="max-w-[400px] space-y-4" enctype="multipart/form-data">
                   <div class="w-full">
                    <label for="title">Titre du document</label>
                    <div>
                        <input 
                            v-model="fileForm.title"
                            type="text" 
                            name="title" 
                            id="title" 
                            class="w-full focus:ring-1 rounded-sm"
                            placeholder="Rapport de fin d'année"
                        >
                    </div>
                   </div>

                   <div class="w-full">
                        <label for="type">Type de document</label>
                        <div>
                            <input 
                                v-model="fileForm.type"
                                type="text" 
                                name="type" 
                                id="type" 
                                class="w-full focus:ring-1 rounded-sm"
                                placeholder="rapport, lettre, note..."
                            >
                        </div>
                   </div>

                   <div class="w-full">
                            <label for="tags">Mots-clés</label>
                            
                            <div>
                                <input 
                                    v-model="fileForm.tags"
                                    type="text" 
                                    name="tags" 
                                    id="tags"
                                    class="w-full focus:ring-1 rounded-sm"
                                    placeholder="Séparer les mots-clés par des virgules"
                                >
                            </div>

                            <Note
                                text="Les mots-clés faciliteront la recherche des différents documents."
                            />
                     </div>

                   <div class="w-full">
                        <label for="content">Contexte ou description</label>
                        <div>
                            <textarea 
                                v-model="fileForm.content"
                                name="content" 
                                id="content"
                                class="w-full field-sizing-content focus:ring-1 rounded-sm resize-y"
                                placeholder="Un résumé ou une brève description du contenu et de la finalité du document"
                            ></textarea>
                        </div>
                   </div>

                   <div class="w-full">
                        <label for="category">Classification ou catégorie</label>
                        <div>
                            <input 
                                v-model="fileForm.category"
                                type="text" 
                                name="category" 
                                id="category"
                                class="w-full focus:ring-1 rounded-sm"
                                placeholder="Exemple: Administratif, Financier, Juridique, personnel, etc."
                            >
                        </div>
                   </div>

                   <div class="w-full">
                        <label for="file">Document à téléverser</label>
                        <div>
                            <input 
                                @change="loadFile"
                                type="file" 
                                name="file" 
                                id="file"
                                accept="/image/*, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt"
                                class="w-full focus:ring-1 rounded bg-black text-white py-2 px-2 border-none"
                            >
                        </div>
                   </div>
                   <div class="w-full">
                            <input 
                                type="submit" 
                                class="w-full p-2 bg-blue-500 hover:bg-blue-600  text-white font-bold rounded mt-4 transition-colors"
                                value="Enregistrer"
                            >
                   </div>

                </form>

                
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SectionHead from '@/Components/SectionHead.vue';
import Note from '@/Components/Note.vue';
import { useForm } from '@inertiajs/vue3';

const fileForm = useForm({
    title: null,
    type: null,
    content: null,
    tags: null,
    category: null,
    file: null

})

function submit() {
    fileForm.post('/test', )
}

const loadFile = (e) => {
    fileForm.file = e.target.files[0]
}

</script>

<style scoped>
form {
    margin: 0 auto;
}

input,
textarea {
    border: 1.2px solid black;
}

</style>