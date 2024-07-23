<script lang="ts" setup>
    import FormContainer from '@/components/FormContainer.vue';
    import { useForm } from '@/hooks/useForm';    
    import Messages from '@/messages/Messages';        
    import router from '@/router';
    import { useAuthStore } from '@/stores/authStore';
    import { string } from 'yup';
    
    const auth = useAuthStore();
    const form = useForm({
        password: '',               
    });

    form.defineYupRules({        
        password: string()
            .min(8, 'password.min')
            .max(255, 'password.max')
            .required('password.required')   
    });

    async function handleSubmit() {
        form.submit({
            method: 'delete',
            url: '/user/delete',
            onSuccess(response) {                 
                setTimeout(() => {
                    iziToast.success({
                        title: 'Sucesso',
                        message: Messages.success(response.data.message ?? '')
                    });               
                }, 1000);
                auth.revokeAuthentication();
                router.push({name: 'welcome'});
            },
        });         
    } 
</script>

    <template>
        <section>            
            <FormContainer title="Atualizar informações do perfil" :handle-submit="() => handleSubmit()">
                <div class="col-12 col-lg-6">
                    <div class="alert alert-danger mb-3">
                        Esta ação é irreversível; portanto, exclua sua conta apenas se estiver absolutamente certo(a) de que quer fazer isso.
                    </div>
                    <div class="mb-3">
                        <label for="password_" class="form-label">Senha</label>
                        <input 
                            v-model="form.data.password"
                            v-max-length="255"
                            type="password" 
                            class="form-control" 
                            id="password_"                            
                        >
                        <small class="text-danger">{{ Messages.error(form.errors.password) }}</small>
                    </div>    
                    <div class="d-flex justify-content-end">        
                        <button class="btn btn-danger col-12 col-lg-3 mb-2" :disabled="form.isProcessing()">
                            Deletar
                        </button>                
                    </div>
                </div>   
            </FormContainer>
        </section>
    </template>