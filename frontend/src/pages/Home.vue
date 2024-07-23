<script setup lang="ts">
    import CardBook from '@/components/CardBook.vue';
    import DefaultLayout from '@/layouts/DefaultLayout.vue';
    import fetchBooksService from '@/services/fetchBooksService';
    import { useBookStore } from '@/stores/bookStore';
    import { onBeforeMount } from 'vue';
    
    const books = useBookStore();
    
    onBeforeMount(() => {
        fetchBooksService({
            path: '/book',
            params: {},
        })
    })

</script>
<template>
    <DefaultLayout>
        <div class="row gap-3 justify-content-center">
            <div class="col-12 col-lg-10-col-xl-8">
                <div class="mb-2">
                    <h5 class="p-0 m-0">Recomendados para você</h5>
                    <small class="p-0 m-0 text-secondary">Sugestões personalizadas para você</small>
                </div>
                <div class="d-flex flex-wrap gap-3 mt-3 justify-content-center">
                    <CardBook v-for="book, key in books.getBooks" :book="book" :key="key"></CardBook>
                </div>
            </div>

            <div class="col-12 col-lg-10-col-xl-8">
                <div class="mb-2">
                    <h5>Favoritos dos usuários</h5>
                    <small class="p-0 m-0 text-secondary">Os mais procurados</small>
                </div>
                <div class="d-flex flex-wrap gap-3 mt-3 justify-content-center">
                    <CardBook v-for="book, key in books.getBooks" :book="book" :key="key"></CardBook>
                </div>
            </div>

            <div class="col-12 col-lg-10-col-xl-8">
                <div class="mb-2">
                    <h5>Últimas novidades</h5>
                    <small class="p-0 m-0 text-secondary">Chegadas fresquinhas</small>
                </div>
                <div class="rounded-2 bg-white shadow-sm p-2"></div>
            </div>
        </div>        
    </DefaultLayout>
</template>