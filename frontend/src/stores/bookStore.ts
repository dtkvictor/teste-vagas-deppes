import { ref, computed, type Ref, type ComputedRef } from 'vue'
import { defineStore } from 'pinia'
import type { Book } from '@/types'

export const useBookStore = defineStore('books', () => {
  const Books:Ref<Array<Book>|null> = ref(null);

  const hasBooks:ComputedRef<boolean> = computed(() => (Books.value && Books.value.length > 0) ? true : false);
  const getBooks:ComputedRef<Array<Book>|null> = computed(() => Books.value);

  function setBooks(newBooks: Array<Book>) {
        Books.value = {
            ...Books.value,
            ...newBooks
        }
  }

  return {
    hasBooks,
    getBooks,
    setBooks,
  }
})
