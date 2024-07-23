<script lang="ts" setup>
    import GuestLayout from '@/layouts/GuestLayout.vue';
    import { RouterLink } from 'vue-router';
</script>

<template>
    <GuestLayout>             
        <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 70vh;">
            <h1>Erro 500</h1>
            <h3>Poxa, parece que tivemos um erro tecnico, mas não se preocupe, pode <RouterLink to="/">voltar ao início clicando aqui</RouterLink>.</h3>
        </div>
    </GuestLayout>
</template>