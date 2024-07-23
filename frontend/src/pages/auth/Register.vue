<script lang="ts" setup>
    import { useForm } from '@/hooks/useForm';
    import GuestLayout from '@/layouts/GuestLayout.vue';
    import FormContainer from '@/pages/auth/partials/FormContainer.vue';
    import { ref, string } from 'yup';
    import Messages from '@/messages/Messages';
    import router from '@/router';
    
    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

    form.defineYupRules({
        name: string()
            .min(3, 'name.min')            
            .max(255, 'name.max')
            .required('name.required'),
                    
        email: string()
            .email('email.invalid')
            .max(255, 'email.max')            
            .required('email.required'), 

        password: string()
            .min(8, 'password.min')
            .max(255, 'password.max')
            .required('password.required'),

        password_confirmation: string()
            .oneOf([ref('password'), null], 'password.confirmed')
            .required('password_confirmation.required'),            
    })    

    async function handleSubmit() {
        form.submit({
            method: 'post',
            url: '/auth/register',
            onSuccess(response) {
                iziToast.success({
                    title: 'Sucesso',
                    message: Messages.success(response.data.message ?? '')
                })
                router.push({name: 'auth.login'})
            },
        });         
    } 
</script>

<template>
    <GuestLayout>     
        <FormContainer title="Registrar" :handle-submit="handleSubmit">                
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input 
                    v-model="form.data.name"
                    v-max-length="255"
                    type="name" 
                    class="form-control" 
                    id="name" 
                    placeholder="Carlos De Souza" 
                    autocomplete="name"
                >
                <small class="text-danger">{{ Messages.error(form.errors.name) }}</small>
            </div>
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
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar senha</label>
                <input 
                    v-model="form.data.password_confirmation"
                    v-max-length="255"
                    type="password" 
                    class="form-control" 
                    id="password_confirmation"
                >
                <small class="text-danger">{{ Messages.error(form.errors.password_confirmation) }}</small>
            </div>                    
            <button class="btn btn-primary w-100 mb-2" :disabled="form.isProcessing()">
                Registrar
            </button>   
            <hr>      
            <div class="d-flex justify-content-center gap-1">
                <span>Já tem uma conta?</span>
                <RouterLink :to="{ name: 'auth.login'}">Realizar login!</RouterLink>
            </div>
        </FormContainer>
    </GuestLayout>
</template>