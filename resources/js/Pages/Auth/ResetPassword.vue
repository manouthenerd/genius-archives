<template>

        <Head title="Créer un nouveau mot de passe" />
    <div class="max-w-[300px] h-full bg-[url(/image/background.svg)] bg-cover">
        <form @submit.prevent="submit()"
            class="h-full min-w-[300px] flex flex-col justify-around border border-solid border-slate-200 p-2 rounded-sm space-y-4">
            <p class="text-center text-white bg-black p-0.5 rounded border border-solid border-[aliceblue]">
                Définir un nouveau mot de passe
            </p>
            
                <ModalItem>
                    <label for="email" class="text-white">Adresse email</label>
                    <Input 
                        v-model="form.email" 
                        name="email" 
                        type="email" 
                        id="email"
                        placeholder="Entrer votre adresse email"
                        class="border border-slate-200 max-w-[283px] focus:outline-none focus:border-0" 
                    />
                    <Transition>
                        <Error 
                            v-if="errors.email" 
                            :message="errors.email" />
                    </Transition>
                </ModalItem>
                
                <ModalItem>
                    <label for="password" class="text-white">Nouveau mot de passe</label>
                    <Input 
                        v-model="form.password" 
                        name="password" 
                        type="password" 
                        id="password"
                        placeholder="Entrer le nouveau mot de passe"
                        class="border border-slate-200 max-w-[283px] focus:outline-none focus:border-0" 
                    />
                    <Transition>
                        <Error 
                            v-if="errors.password" 
                            :message="errors.password" />
                    </Transition>
                </ModalItem>

                <ModalItem>
                    <label for="password_confirmation" class="text-white">Confirmer le mot de passe</label>
                    <Input 
                        v-model="form.password_confirmation" 
                        name="password_confirmation" 
                        type="password" id="password_confirmation"
                        placeholder="Veuillez confirmer le nouveau mot de passe"
                        class="border border-slate-200 max-w-[283px] focus:outline-none focus:border-0" 
                    />
                    <Transition>
                        <Error 
                            v-if="errors.password_confirmation" 
                            :message="errors.password_confirmation" 
                        />
                    </Transition>
                </ModalItem>

                <ModalItem>
                    <Button 
                        :disabled="form.processing" 
                        class="flex items-center justify-center gap-1"
                    >
                        <Transition>
                            <LoaderCircle 
                                v-if="form.processing" 
                                class="animate-spin"
                             />
                        </Transition>
                        <span>Envoyer</span>
                    </Button>
                </ModalItem>
        </form>
    </div>

</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import Button from '@/Components/forms/Button.vue';
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import Error from '@/Components/forms/Error.vue';

defineOptions({
    layout: GuestLayout
})

const props = defineProps({
    token: String,
    email: String,
    errors: Object
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        
        onSuccess: () => form.reset()
    });
};
</script>