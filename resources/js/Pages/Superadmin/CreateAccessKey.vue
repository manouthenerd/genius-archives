<template>
    <!-- <Modal title="Clés d'accès"> -->
    <div class="w-full mt-4 p-2  border border-slate-200 rounded bg-white">
        <form 
            @submit.prevent="submit()"
            class="p-2 max-w-[550px] space-y-8 my-0 mx-auto border border-slate-200 rounded"
        >
            <ModalItem>
                <label for="access_key">
                    Générer une clé
                </label>
                <div class="flex flex-wrap justify-between">
                    <div class="flex items-center gap-2 w-[80%]">
                        <Input 
                            class="bg-[aliceblue] w-full" 
                            type="text" 
                            disabled id="access_key"
                            placeholder="Clés d'accès..." 
                            v-model="form.key"
                        />
                        <span>
                            <Copy v-if="clipboard.status == false" class="stroke-slate-600" @click="clipboard.copyToClipboard(form.key)" />
                            <CheckCheck 
                                v-if="clipboard.status"
                                class="stroke-green-500"
                            />
                        </span>
                    </div>
                    <Input 
                        @click.prevent="generateAccessKey()" 
                        type="image" 
                        class="border-slate-500 bg-slate-300 rounded"
                        src="/icons/generate-password.svg" 
                        alt="icon for password genenration" 
                    />
                </div>
                <Error
                    v-if="form.errors.key"
                    :message="form.errors.key"
                />
            </ModalItem>
        
            <ModalItem>
                <label for="disk_space">
                    Quota d'espace associé
                </label>
                <div class="flex justify-between">
                    <Input 
                        v-model="form.disk_space"
                        type="number" 
                        id="disk_space" 
                        min="0" 
                        placeholder="Définir un quota d'espace..."
                        class="w-[70%]" 
                    />
                    <Select v-model="form.disk_unity" class="w-[20%]">
                        <option value="Go">Go</option>
                    </Select>
                    
                </div>
                <Error
                    v-if="form.errors.disk_space"
                    :message="form.errors.disk_space"
                />
            </ModalItem>
            <ModalItem>
               
                 
                <Button 
                    :class="{'cursor-not-allowed grayscale pointer-events-none' : ! isFilled}"
                    :disabled="! isFilled || form.processing"
                >
                    <span v-if="! form.processing">Enregistrer la clé</span>
                    <Loader class="animate-spin" v-if="form.processing"/>
                </Button>

                <Link href="/access-keys"
                    class="mt-4 text-xs underline text-blue-500 font-bold hover:no-underline transition-all">
                Voir la liste des clés générées
                </Link>
            </ModalItem>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import Button from '@/Components/forms/Button.vue';
import Select from '@/Components/forms/Select.vue';
import { CheckCheck, Copy, Loader } from 'lucide-vue-next';
import { computed, onUnmounted } from 'vue';
import Error from '@/Components/forms/Error.vue';
import { useClipboard } from '@/stores/clipboard';
import { useAlertStore } from '@/stores/alert';

defineOptions({
    layout: SuperAdminLayout
})

const props = defineProps({
    access_key: String
})

const alert = useAlertStore()

const clipboard = useClipboard()

const form = useForm({
    key: '',
    disk_space: "",
    disk_unity: "Mo"
})

const isFilled = computed(() => {
    return ( Boolean((form.key !== "") && (form.lifetime !== "") && (form.disk_space !== "")))
})

const generateAccessKey = () => {
    form.key = props.access_key
    useForm().get(usePage().url, {preserveState: true});
}

const submit = () => {
    form.post(route('access-keys.create'), {
        onSuccess: () => {
            form.reset()
            alert.showAlert()
        }
    })
}

onUnmounted(() => alert.hideAlert())
</script>