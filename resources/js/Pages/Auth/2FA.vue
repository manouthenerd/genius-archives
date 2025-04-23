<template>

    <Head title="Vérification de l'email" />
    <div class="w-full h-screen bg-black flex justify-center items-center">
        <div id="parent"
            class=" bg-[url(/image/background.svg)] bg-cover mx-2 text-white space-y-4 max-w-[550px] p-2 border border-slate-200 rounded">
            <p
                class="uppercase text-center font-bold text-xs gap-1 flex justify-center items-center border p-1 rounded">
                Code de vérification 2FA | <span class="text-blue-500 font-bold"> Genius Data</span>
            </p>
            <p class="underline">
                Un code de vérification à été envoyé à l'addresse email suivante:
            </p>
            <p><span class="bg-blue-500/50 font-thin p-1 rounded">{{ $page.props.auth.user.email ??
                $page.props.auth.member.email }}</span></p>
            <form @submit.prevent="submit">
                <ModalItem class="space-y-2">
                    <label for="code" class="text-white">Entrer le code</label>
                    <div class="flex flex-wrap gap-2">
                        <Input id="digit1" v-model="form.digit1" maxlength="1"
                            class="text-black placeholder:text-gray-300 font-bold text-center" placeholder="1" />
                        <Input id="digit2" v-model="form.digit2" maxlength="1"
                            class="text-black placeholder:text-gray-300 font-bold text-center" placeholder="2" />
                        <Input id="digit3" v-model="form.digit3" maxlength="1"
                            class="text-black placeholder:text-gray-300 font-bold text-center" placeholder="3" />
                        <Input id="digit4" v-model="form.digit4" maxlength="1"
                            class="text-black placeholder:text-gray-300 font-bold text-center" placeholder="4" />
                    </div>
                    <Error :message="form.errors.two_factor_code" />
                    <Button class="w-1/4">
                        <span v-if="!form.processing">Valider</span>
                        <Loader v-if="form.processing" class="animate-spin" />
                    </Button>
                    <!-- <Error v-if="form.errors.email" :message="form.errors.email" /> -->
                </ModalItem>
            </form>
            <p>Nouveau code: {{ timer }}s</p>

            <!-- <p id="canMove">Code non reçu ?
                <Link @click.prevent="refreshTimer()" id="link" as="button" method="put" href="/2fa" :disabled="!canResend"
                    class="text-blue-500" :class="{ 'pointer-events-none grayscale': !canResend }">
                envoyer à nouveau
                </Link>
            </p> -->

            <p>
                <Link as="button" method="post" href="logout" class="text-red-500">
                Se déconnecter
                </Link>
            </p>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Link, Head, useForm } from '@inertiajs/vue3';
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import Button from '@/Components/forms/Button.vue';
import { Loader } from 'lucide-vue-next';
import { useAlertStore } from '@/stores/alert';
import Error from '@/Components/forms/Error.vue';

defineProps({
    status: String
})
const timer = ref(30)
const canResend = ref(false)

const decrementTime = () => {
    let intervalId = setInterval(() => {
        timer.value -= 1

        if (timer.value == 0) {
            clearInterval(intervalId)
            canResend.value = true
        }
    }, 800);
}

const alert = useAlertStore()

const form = useForm({
    digit1: "",
    digit2: "",
    digit3: "",
    digit4: "",
    two_factor_code: ""
})

const moveToNextInput = (currentInputId, nextInputId) => {
    const currentInput = document.getElementById(currentInputId);
    const nextInput = document.getElementById(nextInputId);

    currentInput.addEventListener('input', () => {
        if (currentInput.value.length === currentInput.maxLength) {
            nextInput?.focus()

        }
    });
};

onMounted(() => {
    document.querySelector('#digit1').focus()
    moveToNextInput('digit1', 'digit2');
    moveToNextInput('digit2', 'digit3');
    moveToNextInput('digit3', 'digit4');
    decrementTime();
});

const refreshTimer = () => {

    timer.value = 30
    decrementTime()
    canResend.value = false
    alert.setMessage('Code de vérification envoyé avec succès !')
    alert.showAlert()
}

const submit = () => {
    form.two_factor_code = `${form.digit1}${form.digit2}${form.digit3}${form.digit4}`

    form.post('2fa')
}

window.addEventListener('keydown', (e) => {
    if(e.key == 'Enter') {
        if(form.digit1 && form.digit2 && form.digit3 && form.digit4) {

            submit()
        }

        return null;
    }
})
</script>

<style scoped>
input {
    max-width: 70px;
}
</style>