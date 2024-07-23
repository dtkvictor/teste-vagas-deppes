<script lang="ts" setup>
    import BookContainer from '@/components/BookContainer.vue';
    import Icon from '@/components/Icon.vue';
    import fetchBooksService from '@/services/fetchBooksService';
    import { useBookStore } from '@/stores/bookStore';
    import { onBeforeMount } from 'vue';
    import CardBook from '@/components/CardBook.vue';

    const books = useBookStore();
    
    onBeforeMount(() => {
        fetchBooksService({
            path: '/book',
            params: {},
        })
    })
</script>

<template>
    <BookContainer>        
        <template v-slot:afterFilterButton>
            <RouterLink 
                class="btn btn-outline-secondary d-none d-lg-flex justify-content-center align-items-center"
                :to="{ name: 'bookcase.create' }"
            >                
                <Icon name="add"/>
            </RouterLink>            
        </template>

        <RouterLink 
            class="btn btn-primary d-flex d-lg-none justify-content-center align-items-center rounded-circle shadow-sm position-fixed bottom-0 end-0 m-4" 
            style="width: 50px; height: 50px;"
            :to="{ name: 'bookcase.create' }"
        >
            <Icon name="add"/>
        </RouterLink>            
        <div class="d-flex flex-wrap gap-3 mt-3 justify-content-center">
            <CardBook v-for="book, key in books.getBooks" :book="book" :key="key"></CardBook>
        </div>
    </BookContainer>
</template>