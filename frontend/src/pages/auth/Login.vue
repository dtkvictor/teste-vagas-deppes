<script lang="ts" setup>
    import { useForm } from '@/hooks/useForm';
    import GuestLayout from '@/layouts/GuestLayout.vue';
    import FormContainer from '@/pages/auth/partials/FormContainer.vue';
    import { string } from 'yup';
    import Messages from '@/messages/Messages';
    import { useAuthStore } from '@/stores/authStore';
    import router from '@/router';
    import axios from '@/services/axios';
    
    const auth = useAuthStore();

    const form = useForm({
        email: '',
        password: '',
    });

    form.defineYupRules({
        email: string()
            .email('email.invalid')
            .max(255, 'email.max')            
            .required('email.required'),        
        password: string()
            .max(255, 'password.max')
            .required('password.required'),
    })

    async function refreshToken() 
    {
        const minutesBeforeExpiration = 15;
    
        if(auth.remainingTimeInMinute < minutesBeforeExpiration) {
            axios.post('/auth/refresh').then(response => {            
                auth.updateAuthInformations(response.data.data);
            });                        
        }else {
            const refreshTime = (
                (auth.remainingTimeInMinute - minutesBeforeExpiration) * 60 * 1000
            );                    
            return setTimeout(() => refreshToken(), refreshTime);
        }            
    }

    async function handleSubmit() {
        axios.get('sanctum/csrf-cookie')
        .then(() => {
            form.submit({
                method: 'post',
                url: '/auth/login',
                onSuccess(response) {
                    auth.updateAuthInformations(response.data.data);
                    refreshToken();
                    router.push({name: 'home'});                
                }
            });         
        })
        .catch(() => {
            iziToast.error({
                title: 'Falha na autenticação',
                message: 'Não foi possível realizar a autenticação, tente novamente mais tarde.'
            })
        })

    } 
</script>

<template>
    <GuestLayout>     
        <FormContainer title="Login" :handle-submit="handleSubmit">                
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    v-model="form.data.email"
                    v-max-length="255"
                    type="email" 
                    class="form-control" 
                    id="email" 
                    placeholder="your@email.com" 
                    autocomplete="email"
                >
                <small class="text-danger">{{ Messages.error(form.errors.email) }}</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input                 
                    v-model="form.data.password"
                    v-max-length="255"
                    type="password" 
                    class="form-control" 
                    id="password"
                >
                <small class="text-danger">{{ Messages.error(form.errors.password) }}</small>
            </div>            
            <button class="btn btn-primary w-100 mb-2" :disabled="form.isProcessing()">
                Login
            </button>   
            <hr>      
            <div class="d-flex justify-content-center gap-1">
                <span>Novo por aqui?</span>
                <RouterLink :to="{ name: 'auth.register'}">Crie sua conta agora!</RouterLink>
            </div>
        </FormContainer>
    </GuestLayout>
</template>