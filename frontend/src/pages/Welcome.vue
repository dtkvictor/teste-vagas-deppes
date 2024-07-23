<script lang="ts" setup>
    import ApplicationLogo from '@/components/ApplicationLogo.vue';
    import GuestLayout from '@/layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout class="p-0"> 
        <main class="welcome-container">
            <ApplicationLogo />            
            <h1 class="fw-bold text-start text-lg-center">Um universo de conhecimento ao seu alcance.</h1>
            <h4 class="fw-light text-center">Aqui, cada livro é uma porta para um novo universo.</h4>         
            <div class="d-flex justify-content-center gap-1">
                <RouterLink class="btn btn-outline-secondary btn-lg text-uppercase btn-welcome" :to="{name: 'auth.register'}">
                    Fazer parte
                </RouterLink>

                <RouterLink class="btn btn-primary btn-lg text-uppercase btn-welcome" :to="{name: 'auth.login'}">
                    Entrar
                </RouterLink>
            </div>
        </main>                
    </GuestLayout>
    <div class="welcome-image-footer"></div>
</template>