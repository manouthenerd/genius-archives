<template>

    <Head title="Connexion" />
    <GuestLayout>
        <div class="max-w-[300px] h-full bg-[url(/image/background.svg)] bg-cover">
            <form
                class="h-full flex flex-col justify-around border border-solid border-slate-200 p-2 rounded-sm space-y-4">
                <p class="text-center text-white bg-black p-0.5 rounded border border-solid border-[aliceblue]">
                    Page de connexion
                </p>
                <div class="space-y-4">
                    <ModalItem>
                        <label for="email" class="text-white">Adresse email</label>
                        <Input class="border border-slate-200 focus:outline-none focus:border-0" type="email" id="email"
                            name="email" />
                    </ModalItem>
                    <ModalItem>
                        <label for="password" class="text-white">Mot de passe</label>
                        <Input class="border border-slate-200 focus:outline-none focus:border-0" type="password"
                            id="password" name="password" />
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
                        <input type="submit" value="Se connecter"
                            class="bg-blue-500 hover:opacity-90 transition-opacity text-center font-bold text-white p-2 rounded" />
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
    </GuestLayout>
</template>

<script setup>
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';


const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style scoped>
form,
#skew-box {
    transition: all 1s;
}

form {
    align-content: center;
    transform: skewY(16deg);
    border-top-right-radius: 20px;
}

#skew-box {
    transform: skewY(-16deg);
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