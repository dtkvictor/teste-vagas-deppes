<script lang="ts" setup>
    import { RouterLink } from 'vue-router';
    import Icon from '@/components/Icon.vue';    

    defineProps({
        active: {
            type: Function,
            required: true,
        }
    });

</script>
<template>
    <div class="navbar-nav d-none d-lg-flex">
        <RouterLink :class="['d-flex nav-link gap-1', active('home')]" :to="{ name: 'home' }">
            <Icon name="home" :rounded="true" />
            <span class="d-flex align-items-center">Início</span>
        </RouterLink>
        <RouterLink :class="['d-flex nav-link gap-1', active('books')]" :to="{ name: 'books' }">
            <Icon name="book" :rounded="true" />
            <span class="d-flex align-items-center">Livros</span>
        </RouterLink> 
        <RouterLink :class="['d-flex nav-link gap-1', active('shelf')]" :to="{ name: 'bookcase' }">
            <Icon name="library_books" :rounded="true" />
            <span class="d-flex align-items-center">Estante</span>
        </RouterLink>
        <RouterLink :class="['d-flex nav-link gap-1', active('profile')]" :to="{ name: 'profile'}">
            <Icon name="person" :rounded="true" />
            <span class="d-flex align-items-center">Perfil</span>
        </RouterLink>                                                       
    </div>   
</template>