<template>
    <div class="flex items-center space-x-4">
        <SectionHead :title="`Mon dossier: ${folder.name}(${files.length})`" />
        <Button @click="confirmationModal.openModal()">
            <Trash2 class="stroke-red-500" />
        </Button>
    </div>
    <div class="h-full w-full bg-white py-4 rounded flex gap-4 flex-wrap px-4">
        <template v-for="file in files" :key="file.id">
            <div :class="fileData(file).color" :title="file.name"
                class="max-w-[213px] border-2 border-dashed rounded-tr-2xl border-black p-2 rounded-sm space-y-2">
                <div>
                    <pre class="w-[193px] text-ellipsis overflow-hidden">Titre: {{ file.name }}</pre>
                    <pre>Type: Fichier {{ file.file_type }}</pre>
                    <pre>Auteur: Moi</pre>
                    <pre>Taille: {{ file.file_size.toFixed(0) }} Ko</pre>
                    <p>Modifié le: {{ file.created_at.split('T')[0] }}</p>
                </div>
                <div class="flex flex-col space-y-2 justify-center">

                    <div class="h-[50px] w-full flex justify-center">
                        <img :src="fileData(file).svg" alt="document illustration">
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 flex justify-end">
                            <Download size="15" />
                            <span>33</span>
                        </p>
                        <p class="mt-2 flex justify-between px-1">
                            <a :href="file.download_path" target="_blank"
                                class="text-gray-400 font-medium hover:text-black">
                                Télécharger
                            </a>
                            <Link :href="`/archives/${file.id}`" as="button" method="post">
                            <Trash2 color="#9ca3af" class="hover:stroke-red-500" />
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script setup>
import SectionHead from '@/Components/SectionHead.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Download, Trash2 } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { useConfirmationModal } from '@/stores/confirmationModal';
import { reactive } from 'vue';

defineOptions({
    layout: MainLayout
})

const confirmationModal = useConfirmationModal()

const colors = reactive({
    music: 'bg-[#f4efef]',
    word: 'bg-[#2766ae5c]',
    file: 'bg-[#f9ebb282]',
    video: 'bg-[#e539352e]',
    excel: 'bg-[#27ae683d]',
    powerpoint: 'bg-[#f69b8347]',
    image: "#e8e7e382",
    pdf: '#ffe8e8'
})

const fileData = (file) => {

    if (file.file_type.match(file.file_type.toUpperCase())) {

        let type = file.file_type.toLowerCase()

        return {
            color: colors[type],
            svg: `/icons/illustrations/${type}.svg`
        }
    }

    return {
        color: colors.file,
        svg: '/icons/illustrations/file.svg',
    }
}

const props = defineProps({
    files: Array,
    folder: String
})


confirmationModal.setRequestUrl(`${props.folder.id}/delete`)


</script>

<style scoped>
button:hover {
    transition: all .5s ease;

}
</style>