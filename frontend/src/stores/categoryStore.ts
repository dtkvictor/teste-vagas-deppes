import { ref, computed, type Ref, type ComputedRef } from 'vue'
import { defineStore } from 'pinia'
import type { Category } from '@/types'

export const useCategoriesStore = defineStore('categories', () => {
  const categories:Ref<Array<Category>|null> = ref(null);

  const hasCategories:ComputedRef<boolean> = computed(() => (categories.value && categories.value.length > 0) ? true : false);
  const getCategories:ComputedRef<Array<Category>|null> = computed(() => categories.value);

  function setCategories(newCategories: Array<Category>) {
        categories.value = {
            ...categories.value,
            ...newCategories
        }
  }

  return {
    hasCategories,
    getCategories,
    setCategories,
  }
})
