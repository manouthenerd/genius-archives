<template>

    <AuthenticatedLayout>
        <div>
            <div class="flex justify-between">
                <SectionHead title="Mes archives" />
                <div>
                    <input type="date" name="date" id="date" class="rounded-sm border-blue-600/30">
                    <select name="doc-type" id="doc-type" class="rounded-sm border-blue-600/30">
                        <option value="mix">Docs mix</option>
                        <option value="pdf">PDF</option>
                        <option value="world">WORD</option>
                        <option value="excel">EXCEL</option>
                        <option value="image">IMAGE</option>
                    </select>
                    <input type="button" value="Rechercher"
                        class="bg-blue-600/80 hover:bg-blue-600 transition-colors h-[41.33px] px-1 rounded-sm font-bold text-center text-white">
                </div>
            </div>

            <section class="mt-4">
                <div
                    class="grid grid-cols-[repeat(auto-fill,minmax(200px,1fr))] justify-items-center  gap-x-[10px] gap-y-[20px] py-4">

                    <div v-for="id in 6" :key="id" class="box bg-[whitesmoke] hover:bg-white group flex flex-col justify-between space-y-2 shadow w-[200px] min-h-[200px]">

                        <p title="Titre du document et le rete est du blabla" class="text-center px-1 bg-black text-white w-[200px]  overflow-hidden text-nowrap text-ellipsis">Titre du document et le rete est du blabla</p>
                        <div class="rounded-sm flex justify-center">
                            <img src="/image/word.png" alt="word picture" class="h-[100px] transition-all grayscale group-hover:grayscale-0 group-hover:opacity-100 opacity-[0.3]">
                        </div>
                        <div class="flex flex-col space-y-4  px-2">
                            <p class="flex gap-1 justify-between">
                                <span>prévisualiser</span>
                                <Link href="#">
                                    <img  src="/icons/eye.svg" alt="eye icon">
                                </Link>
                            </p>
                            <div class="flex justify-between items-center mt-4 transition-all">
                                <Link href="#" class="w-3/4 text-center ring-1 ring-black rounded-sm">Modifier</Link>
                                <Link href="#" class="w-1/4 ">
                                    <img title="supprimer" src="/icons/delete.svg" alt=" trash svg" class="float-right">
                                </Link>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import SectionHead from "@/Components/SectionHead.vue"

</script>

<style scoped>
.box {
    transition: all .5s;
}
.box > * {
    transition: all .5s;
}

</style>