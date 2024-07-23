import { useBookStore } from "@/stores/bookStore";

export default function({
    path,
    params,
    onSuccess, 
    onError,
}: {
    path: String,
    params: Record<string, any>
    onSuccess?: VoidFunction, 
    onError?: VoidFunction
}) {
    const books = useBookStore();

    axios.get('/books')
        .then(response => {        
            books.setBooks(response.data.data);
            if(onSuccess) onSuccess();            
        })
        .catch(error => {
            if(onError) onError();
            iziToast.error({
                title: 'Error',
                message: 'Não foi possivel carregar os livros.'
            })
        })
}