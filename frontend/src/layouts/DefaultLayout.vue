<script lang="ts" setup>
    import ApplicationLogo from '@/components/ApplicationLogo.vue';    
    import Icon from '@/components/Icon.vue';
    import { useRoute } from 'vue-router';    
    import { useAuthStore } from '@/stores/authStore';
    import NavLinks from './partials/NavLinks.vue';
    import MobileNavLinks from './partials/MobileNavLinks.vue';
    import router from '@/router';    
    import axios from '@/services/axios';
    import iziToast from 'izitoast';

    defineProps({
        class: String
    })

    const auth = useAuthStore();
    const route = useRoute();

    function active(routeName: string) {
        const currentRouteName = route.name as string;                
        if(!currentRouteName.includes(routeName)) return '';
        return 'active border-bottom border-3 border-primary border-opacity-75'
    }

    function handleLogout() 
    {        
        axios.post('/auth/logout').then(() => {
            auth.revokeAuthentication();
            router.push({ name: 'auth.login' });
        }).catch(error => {            
            console.log(error);
            iziToast.error({
                title: 'Error',
                message: 'Ocorreu um error durante a tentativa de logout.'
            })
        })         
    }

</script>
<template>
    <div class="w-100 h-100">
        <header class="shadow-sm">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-lg justify-content-between">                                            
                    <RouterLink to="/" class="underline-none text-black">
                        <ApplicationLogo />
                    </RouterLink>                                 
                
                    <div class="w-100 d-flex justify-content-start d-lg-none mt-1 mb-2 border-bottom">
                        <span class="text-dark fw-light col-12 text-truncate">
                            Olá, {{ auth.getUser?.name }}!
                        </span>                        
                    </div>                    
                    
                    <NavLinks 
                        :active="active"
                    />

                    <MobileNavLinks 
                        :active="active"
                        :handle-logout="handleLogout" 
                    />

                    <div class="dropdown d-none d-lg-flex">                        
                        <a class="ps-1 text-dark underline-none cursor-pointer fw-medium dropdown-toggle" 
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                            v-max-letters="20"
                        >                        
                            Olá, {{ auth.getUser?.name }}!                                                    
                        </a>                    
                        <ul class="dropdown-menu border-top-0 rounded-top-0 rounded-1">
                            <li class="px-1">                                
                                <button class="d-flex nav-link text-danger" @click="handleLogout">
                                    <Icon name="logout" />
                                    <span>Logout</span>
                                </button>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </nav>
        </header>        
        <div :class="[$props.class, 'container-lg']">
            <slot />
        </div>
    </div>
</template>