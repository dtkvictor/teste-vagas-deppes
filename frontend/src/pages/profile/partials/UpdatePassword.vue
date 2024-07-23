<script lang="ts" setup>
    import FormContainer from '@/components/FormContainer.vue';
    import { useForm } from '@/hooks/useForm';
    import { ref, string } from 'yup';
    import Messages from '@/messages/Messages';    

    const form = useForm({        
        current_password: '',
        password: '',
        password_confirmation: '',        
    });

    form.defineYupRules({
        current_password: string().required('current_password.required'),

        password: string()
            .min(8, 'password.min')
            .max(255, 'password.max')
            .required('password.required'),   

        password_confirmation: string()
            .oneOf([ref('password'), null], 'password.confirmed')
            .required('password_confirmation.required'),             
    });

    async function handleSubmit() {    
        console.log(form.getErrors())
        form.submit({
            method: 'put',
            url: '/user/update/password',
            onSuccess(response) {                
                iziToast.success({
                    title: 'Sucesso',
                    message: Messages.success(response.data.message ?? '')
                });                
            },
            onError(error) {
                console.log(form.getErrors())
                console.log(error);
            },
            onFinally() {
                form.resetData();                                
            },
        });         
    } 
</script>

    <template>
        <section>            
            <FormContainer title="Atualizar senha" :handle-submit="() => handleSubmit()">
                <div class="w-100 d-flex">
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Senha Atual</label>
                            <input 
                                v-model="form.data.current_password"
                                v-max-length="255"
                                type="password" 
                                class="form-control" 
                                id="current_password"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.current_password) }}</small>
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