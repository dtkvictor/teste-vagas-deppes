<script lang="ts" setup>
    import FormContainer from '@/components/FormContainer.vue';
    import { useForm } from '@/hooks/useForm';
    import { string } from 'yup';
    import Messages from '@/messages/Messages';
    import { useAuthStore } from '@/stores/authStore';
    import type { User } from '@/types';
    
    const auth = useAuthStore();

    const form = useForm({
        name: auth.getUser?.name,
        email: auth.getUser?.email,
    });

    form.defineYupRules({
        name: string()
            .min(3, 'name.min')            
            .max(255, 'name.max')
            .required('name.required'),
                    
        email: string()
            .email('email.invalid')
            .max(255, 'email.max')            
            .required('email.required')
    })

    async function handleSubmit() {
        form.submit({
            method: 'put',
            url: '/user/update',
            onSuccess(response) {
                auth.updateUserInformations(form.getData() as User);
                iziToast.success({
                    title: 'Sucesso',
                    message: Messages.success(response.data.message ?? '')
                });                
            }            
        });         
    } 
</script>

    <template>
        <section>            
            <FormContainer title="Atualizar informações do perfil" :handle-submit="handleSubmit">
                <div class="w-100 d-flex">
                    <div class="col-12 col-lg-6">
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
                        <div class="d-flex justify-content-end">        
                            <button class="btn btn-primary col-12 col-lg-3 mb-2" :disabled="form.isProcessing()">
                                Salvar
                            </button>                
                        </div>   
                    </div>                       
                </div>
            </FormContainer>
        </section>
    </template>