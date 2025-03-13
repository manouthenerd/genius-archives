<template>

    <div
        class="backdrop-blur-sm flex justify-center items-center h-screen w-screen fixed overflow-auto z-100 left-0 top-0 bg-[rgba(0,0,0,0.4)] rounded-sm border">
        <div class="bg-gradient-to-r from-slate-100 to-orange-50 via-blue-100 space-y-4 mx-3 shadow-sm p-4 grid rounded w-[550px] bg-slate-50">

            <div class="flex justify-between items-center">

                <h4 class="font-bold text-blue-500">{{ title }}</h4>
                <button 
                    @click="$emit('close-event')" 
                    id="close" 
                    class="text-white flex justify-center items-center bg-blue-500 text-center font-bold size-[20px] rounded"
                >
                    X
                </button>
            </div>

            <div class="space-y-4 justify-self-center">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script setup>

defineProps({
    title: {
        type: String,
        required: true
    }
})


</script>

<style scoped>
h4 {
    text-shadow: 0 0 0 #000;
}

#close {
    box-shadow: 1px 1px 1px #000;
}
</style>
