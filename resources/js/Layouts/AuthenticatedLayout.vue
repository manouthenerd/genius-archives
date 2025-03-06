<template>
    <MainLayout v-if="user.role !== 'superadmin'"/>

    <SuperAdminLayout v-if="user.role == 'superadmin'"/>

</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import MainLayout from './MainLayout.vue';
import SuperAdminLayout from './SuperAdminLayout.vue';

const user = usePage().props.auth.user
</script>