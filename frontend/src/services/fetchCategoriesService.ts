import { useCategoriesStore } from "@/stores/categoryStore";

export default function({onSuccess, onError}: {onSuccess?: VoidFunction, onError?: VoidFunction}) {
    const categories = useCategoriesStore();

    axios.get('/categories')
        .then(response => {        
            categories.setCategories(response.data.data);
            if(onSuccess) onSuccess();            
        })
        .catch(error => {
            if(onError) onError();
            iziToast.error({
                title: 'Error',
                message: 'Não foi possivel carregar as categorias.'
            })
        })
}