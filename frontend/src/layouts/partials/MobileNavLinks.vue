<script lang="ts" setup>
    import { RouterLink } from 'vue-router';
    import Icon from '@/components/Icon.vue';

    defineProps({
        handleLogout: {
            type: Function,
            required: true,
        },
        active: {
            type: Function,
            required: true,
        }
    });

    const routerLinkCssClass: string = 'd-flex align-items-center flex-column nav-link';

</script>

<template>
    <div class="w-100 navbar-nav d-flex flex-row d-lg-none justify-content-evenly mt-1">                            
        <RouterLink :class="[routerLinkCssClass, active('home')]" :to="{ name: 'home' }">
            <Icon name="home" :rounded="true" />
            <span>Início</span>
        </RouterLink>
        <RouterLink :class="[routerLinkCssClass, active('books')]" :to="{ name: 'books' }">
            <Icon name="book" :rounded="true" />
            <span>Livros</span>
        </RouterLink> 
        <RouterLink :class="[routerLinkCssClass, active('shelf')]" :to="{ name: 'bookcase' }">
            <Icon name="library_books" :rounded="true" />
            <span>Estante</span>
        </RouterLink>
        <RouterLink :class="[routerLinkCssClass, active('profile')]" :to="{ name: 'profile'}">
            <Icon name="person" :rounded="true" />
            <span>Perfil</span>
        </RouterLink>   
        <a :class="[routerLinkCssClass, 'text-danger']" @click="() => handleLogout()">
            <Icon name="logout" :rounded="true" class="bg-white" />
            <span>Logout</span>
        </a>                                                    
    </div>   
</template>