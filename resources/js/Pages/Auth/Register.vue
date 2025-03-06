<template>

    <Head title="Connexion" />
        <div class="max-w-[315px] h-full bg-[url(/image/background.svg)] bg-cover">
            <form
                @submit.prevent="submit()"
                class="flex flex-col h-full justify-around border border-solid border-slate-200 p-2 rounded-sm space-y-4">
                <p class="text-center text-white border-b-transparent bg-black p-0.5 rounded border border-solid border-[aliceblue]">
                    Page d'inscription
                </p>
                <div class="space-y-4">
                    <ModalItem>
                        <label for="name" class="text-white">Nom et prénoms</label>
                        <Input 
                            v-model="form.name"
                            name="name" 
                            type="text" id="name"
                            class="border border-slate-200 focus:outline-none focus:border-0"
                        />
                        <Error :message="form.errors.name"/>
                    </ModalItem>

                    <ModalItem>
                        <label for="email" class="text-white">Adresse email</label>
                        <Input 
                            v-model="form.email"
                            name="email"
                            type="email" id="email"
                            class="border border-slate-200 focus:outline-none focus:border-0"
                        />
                        <Error :message="form.errors.email"/>
                    </ModalItem>

                    <ModalItem>
                        <label for="access_key" class="text-white">Clés d'accès </label>
                        <Input 
                            v-model="form.access_key"
                            id="access_key" 
                            type="text"
                            name="access_key"
                            class="border border-slate-200 focus:outline-none focus:border-0"
                        />
                        <Error :message="form.errors.access_key"/>
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
                        <Error :message="form.errors.password"/>
                    </ModalItem>

                    <p class="text-xs text-white">
                        Déjà un compte ? 
                        <Link href="/connexion" class="text-blue-500">Je me connecte</Link>
                    </p>
                    <ModalItem>
                        <input type="submit" value="S'inscrire"
                            class="bg-blue-500 z-[999] hover:opacity-90 transition-opacity text-center font-bold text-white p-2 rounded" />
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
import Error from '@/Components/forms/Error.vue';

defineOptions({
    layout: GuestLayout
})
const form = useForm({
    name: '',
    email: '',
    password: '',
    access_key: ''
});

const submit = () => {
    form.post('/inscription');
};
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
    transform: skewY(14deg);
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