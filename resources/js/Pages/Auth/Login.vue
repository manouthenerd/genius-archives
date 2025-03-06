<template>

    <Head title="Connexion" />
        <div class="max-w-[300px] h-full bg-[url(/image/background.svg)] bg-cover">
            <form
                @submit.prevent="submit()"
                class="h-full flex flex-col justify-around border border-solid border-slate-200 p-2 rounded-sm space-y-4">
                <p class="text-center text-white bg-black p-0.5 rounded border border-solid border-[aliceblue]">
                    Page de connexion
                </p>
                <div class="space-y-4">
                    <ModalItem>
                        <label for="email" class="text-white">Adresse email</label>
                        <Input 
                            v-model="form.email"
                            name="email"
                            type="email" id="email"
                            class="border border-slate-200 focus:outline-none focus:border-0"
                        />
                        <Error 
                            v-if="form.errors.email"
                            :message="form.errors.email"
                            />
                    </ModalItem>
                    <ModalItem>
                        <label for="password" class="text-white">Mot de passe</label>
                        <Input 
                            v-model="form.password"
                            id="password"
                            type="password" 
                            name="password"
                            class="border border-slate-200 focus:outline-none focus:border-0" 
                        />
                        <Error 
                            v-if="form.errors.password" 
                            :message="form.errors.password"
                        />
                        <Error 
                            v-if="form.errors[0]" 
                            :message="form.errors[0]"
                        />
                    </ModalItem>
                    <p class="text-xs text-white">
                        Pas de compte ? 
                        <Link href="/inscription" class="text-blue-500">Créer un compte</Link>
                    </p>
                    <p class="text-xs text-white">
                        Mot de passe oublié ? 
                        <Link href="/reintialisation-mot-de-passe" class="text-blue-500">Réintialiser mon mot de passe</Link>
                    </p>
                    <ModalItem>
                        <SubmitButton :disabled="form.processing" value="Se connecter"/>
                    </ModalItem>
                </div>
            </form>
        </div>

        <div class="max-w-[300px] h-full bg-[url(/image/background.svg)] bg-cover">

            <div id="skew-box"
                class="h-full w-[262px] flex flex-col justify-around border border-solid border-slate-200 text-white font-bold p-2 rounded-sm space-y-4">
                <div class="text-center text-white bg-black p-0.5 rounded ">
                    <p>
                        Genius <span class="text-blue-500">Archives</span>
                    </p>
                    
                </div>
                
            </div>

        </div>
</template>

<script setup>
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import SubmitButton from '@/Components/forms/SubmitButton.vue';
import Error from '@/Components/forms/Error.vue';

defineOptions({
    layout: GuestLayout
})

const form = useForm({
    email: '',
    password: '',
});


function submit() {
    form.post('/connexion')
}

</script>


<style scoped>
form,
#skew-box {
    transition: all 1s;
}

form {
    align-content: center;
    transform: skewY(-16deg);
    border-top-right-radius: 20px;
}

#skew-box {
    transform: skewY(18deg);
    border-top-left-radius: 20px;
}

#parent:hover form {
    transform: skewY(0);
    border-right: transparent;
    border-top-right-radius: 0;
}

#parent:hover #skew-box {
    border-left: transparent;
    transform: skewY(0);
    border-top-left-radius: 0;
}
</style>