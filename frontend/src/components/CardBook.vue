<script lang="ts" setup>
    import type { Book } from '@/types';

    defineProps({
        book: Object as () => Book
    })

</script>

<template>
    <div class="col-4 col-lg-3 col-xl-2">
        <div class="card shadow-sm position-relative" style="aspect-ratio: 1 / 1.2;">
            <img v-lazy="book?.thumb" class="img-overlay position-absolute w-100 h-100 top-0 rounded" alt="..." @error="this.src=book?.thumb_url">            
        </div>
        <div class="card-body mt-1">
            <h5 class="card-title">{{ book?.title }}</h5>
            <p class="card-text" v-max-letters="50">
                {{ book?.author }}
                <small>{{ book?.category.name }}</small>
            </p>            
            <slot />            
        </div>
    </div>
</template>

<style scoped>
    .img-overlay {
        
    }
    .img-overlay::after {
        background: rgba(0, 0, 0, .5);
        position: absolute;
        z-index: 10;
        
    }
</style>