<template>
    <Head title="Vérification de l'email"/>
    <div class="w-full h-screen bg-black flex justify-center items-center">
        <div
            id="parent"
            class=" bg-[url(/image/background.svg)] bg-cover mx-2 text-white space-y-4 max-w-[550px] p-2 border border-slate-200 rounded">
            <p
                class="uppercase text-center font-bold text-xs gap-1 flex justify-center items-center border p-1 rounded">
                Vérification email | <span class="text-blue-500 font-bold"> Genius Archives</span>
            </p>
            <p class="underline">
                Un lien de vérification à été envoyé à l'addresse email suivante:
            </p>
            <p><span class="bg-blue-500/50 font-thin p-1 rounded">{{ $page.props.auth.user.email ??  $page.props.auth.member.email }}</span></p>
            <p>Nouveau lien dans: {{ timer }}s</p>
            <p id="canMove">Lien non reçu ?
                <Link 
                    @click="refreshTimer()"
                    id="link"
                    as="button" 
                    method="post" 
                    href="/email/verification-notification" 
                    :disabled="! canResend"
                    class="text-blue-500"
                    :class="{'pointer-events-none grayscale' : ! canResend}"
                >
                    envoyer à nouveau
                </Link>
            </p>

            <p>
                <Link 
                    as="button"
                    method="post"
                    href="logout" 
                    class="text-red-500"
                >
                    Se déconnecter
                </Link>
            </p>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    status: String
})
const timer = ref(60)
const canResend = ref(false)

const decrementTime = () => {
    let intervalId = setInterval(() => {
        timer.value -= 1

        if (timer.value == 0) {
            clearInterval(intervalId)
            canResend.value = true
        }
    }, 1000);
}

onMounted(() => decrementTime())

const refreshTimer = () => {

    timer.value = 60
    decrementTime()
    canResend.value = false
}


</script>