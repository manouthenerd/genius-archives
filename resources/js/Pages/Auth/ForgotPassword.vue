<template>

    <Head title="Mot de passe oublié" />
    <div class="max-w-[300px] h-full bg-[url(/image/background.svg)] bg-cover">
        <form @submit.prevent="submit()"
            class="h-full min-w-[300px] flex flex-col justify-around border border-solid border-slate-200 p-2 rounded-sm space-y-4">
            <p class="text-center text-white bg-black p-0.5 rounded border border-solid border-[aliceblue]">
                Réintialisation du mot de passe
            </p>
            <Transition>
                <p v-if="status" class="text-xs text-blue-500 text-wrap underline">
                    {{ status }}
                </p>
            </Transition>
                <ModalItem>
                    <label for="email" class="text-white">Adresse email</label>
                    <Input v-model="form.email" name="email" type="email" id="email"
                        placeholder="Entrer votre adresse email"
                        class="border border-slate-200 max-w-[283px] focus:outline-none focus:border-0" />
                    <Transition>
                        <Error v-if="form.errors.email" :message="form.errors.email" />
                    </Transition>
                </ModalItem>

                <p class="text-xs text-white">
                    Pas de compte ?
                    <Link href="/inscription" class="text-blue-500">Créer un compte</Link>
                </p>

                <ModalItem>
                    <Button>
                        <span v-if="!form.processing">Envoyer</span>
                        <Loader v-if="form.processing" color="white" class="animate-spin" />
                    </Button>
                </ModalItem>
        </form>
    </div>

</template>

<script setup>
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import Button from '@/Components/forms/Button.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Error from '@/Components/forms/Error.vue';
import { Loader } from 'lucide-vue-next';

defineOptions({
    layout: GuestLayout
})


const props = defineProps({
    status: String
})

const form = useForm({
    email: '',
});

function submit() {
    form.post('/forgot-password', {
        onSuccess: () => form.reset('email')
    })
}

</script>

<style scoped>
    /* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

</style>