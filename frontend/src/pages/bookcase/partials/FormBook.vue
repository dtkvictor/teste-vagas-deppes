<script lang="ts" setup>
    import FormContainer from '@/components/FormContainer.vue';
    import { useForm } from '@/hooks/useForm';
    import { string, number } from 'yup';
    import Messages from '@/messages/Messages';    
    import type { Book } from '@/types';
    import InputImage from '@/components/InputImage.vue';
    import { useCategoriesStore } from '@/stores/categoryStore';
    import { onBeforeMount } from 'vue';
    import fetchCategoriesService from '@/services/fetchCategoriesService';
import router from '@/router';
    
    const props = defineProps({
        book: Object as () => Book,
        method: {
            type: String,
            required: true,
        },
        url: {
            type: String,
            required: true,
        },        
    });

    const categories = useCategoriesStore();

    const form = useForm({
        thumb: undefined,
        title: props?.book?.title ?? undefined,
        author: props?.book?.author ?? undefined,
        isbn: props?.book?.isbn ?? undefined,
        description: props?.book?.description ?? undefined,
        number_pages: props?.book?.number_pages ?? undefined,
        language: props?.book?.language ?? undefined,
        publisher: props?.book?.publisher ?? undefined,                
        category_id: props?.book?.category ?? undefined,        
    });

    form.defineYupRules({
        
        title: string()
            .min(3, 'title.min')            
            .max(255, 'title.max')
            .required('title.required'),        

        author: string()
            .min(3, 'author.min')            
            .max(255, 'author.max')
            .required('author.required'),

        isbn: string()
            .min(10, 'isbn.min')            
            .max(20, 'isbn.max')
            .required('isbn.required'),

        description:  string()
            .min(3, 'description.min')            
            .max(500, 'description.max')
            .required('description.required'),        

        number_pages: number()
            .min(1, 'number_page.min_digits')
            .max(2000, 'number_pages.max_digits')
            .required('number_pages.reuired'),

        language: string()
            .min(2, 'language.min')            
            .max(2, 'language.max')
            .required('language.required'),

        publisher: string()
            .min(3, 'publisher.min')
            .max(255, 'publisher.max')
            .required('publisher.required'),       

        category_id: number().required('category.required'),             
    })

    async function handleSubmit() {
        form.submit({
            method: props.method,
            url: props.url,
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onSuccess(response) {       
                if(props.method.toLocaleLowerCase() == 'post') {
                    form.resetData();                    
                }
                iziToast.success({
                    title: 'Sucesso',
                    message: Messages.success(response.data.message ?? '')
                });                
            }, 
            onError(error){
                console.log(error);
            }            
        });         
    } 

    onBeforeMount(() => {
        if(categories.hasCategories) return;
        fetchCategoriesService({
            onSuccess: () => {
                form.data.category_id = categories.getCategories[0].id;
            },
        })
    });
</script>

    <template>
        <section>            
            <FormContainer :title="
                method.toLocaleLowerCase() == 'post' ? 'Adicionar Livro' : 'Atualizar informações do Livro'
            " :handle-submit="handleSubmit">
                <div class="w-100 d-flex flex-wrap gap-1 bookcase-form">             
                        <div class="w-100 mb-3">       
                            <InputImage 
                                @load-file="event => form.data.thumb = event"
                            />
                            <small class="text-danger">{{ Messages.error(form.errors.thumb) }}</small>
                        </div>
                        
                        <div class="mb-3 bookcase-input-container">                            
                            <label for="title" class="form-label">Título</label>
                            <input 
                                v-model="form.data.title"
                                v-max-length="255"
                                type="text" 
                                class="form-control" 
                                id="title" 
                                placeholder="Carlos De Souza" 
                                autocomplete="title"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.title) }}</small>
                        </div>
                        
                        <div class="mb-3 bookcase-input-container">
                            <label for="author" class="form-label">Author</label>
                            <input 
                                v-model="form.data.author"
                                v-max-length="255"
                                type="text" 
                                class="form-control" 
                                id="author"
                                autocomplete="author"
                                placeholder="William Shakespeare" 
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.author) }}</small>
                        </div>
                        
                        <div class="mb-3 bookcase-input-container">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input 
                                v-model="form.data.isbn"
                                v-max-length="20"
                                type="text" 
                                class="form-control" 
                                id="isbn"
                                autocomplete="isbn"
                                placeholder="0000000000"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.isbn) }}</small>
                        </div>                        
                        
                        <div class="mb-3 bookcase-input-container">
                            <label for="number_pages" class="form-label">Número de páginas</label>
                            <input 
                                v-model="form.data.number_pages"
                                v-max-length="2000"
                                type="number" 
                                class="form-control" 
                                id="number_pages"
                                autocomplete="number_pages"
                                placeholder="200"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.number_pages) }}</small>
                        </div>
                        
                        <div class="mb-3 bookcase-input-container">
                            <label for="language" class="form-label">Idioma</label>
                            <input 
                                v-model="form.data.language"
                                v-max-length="2"
                                type="text" 
                                class="form-control" 
                                id="language"
                                autocomplete="language"
                                placeholder="pt"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.language) }}</small>
                        </div>

                        <div class="mb-3 bookcase-input-container">
                            <label for="publisher" class="form-label">Editora</label>
                            <input 
                                v-model="form.data.publisher"
                                v-max-length="255"
                                type="text" 
                                class="form-control" 
                                id="publisher"
                                autocomplete="publisher"
                                placeholder="Viva Editora"
                            >
                            <small class="text-danger">{{ Messages.error(form.errors.publisher) }}</small>
                        </div>    
                           
                        <div class="mb-3 w-100">
                            <label for="language" class="form-label">Categoria</label>
                            <select class="form-select form-select-lg mb-3" v-model="form.data.category_id">                                                            
                                <option v-for="category, key in categories.getCategories" :value="category.id" :key="key">
                                    {{ category.name }}    
                                </option>                                
                            </select>
                            <small class="text-danger">{{ Messages.error(form.errors.category_id) }}</small>
                        </div>                               
                        
                        <div class="mb-3 w-100">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea 
                                v-model="form.data.description"
                                v-max-length="255"
                                type="text" 
                                class="form-control" 
                                id="description"
                                autocomplete="description"
                                placeholder="Romeu e Julieta é uma tragédia escrita entre 1591 e 1595, nos primórdios da carreira literária de William Shakespeare, sobre dois adolescentes cuja morte acaba unindo suas famílias, outrora em pé de guerra. "
                            ></textarea>                            
                            <small class="text-danger">{{ Messages.error(form.errors.description) }}</small>
                        </div>                                     

                        <div class="d-flex justify-content-end col-12">        
                            <button class="btn btn-primary col-12 col-lg-3 mb-2" :disabled="form.isProcessing()">
                                {{ method.toLocaleLowerCase() == 'post' ? 'Salvar' : 'Atualizar' }}
                            </button>                
                        </div>   
                    </div>                            
            </FormContainer>
        </section>
    </template>

