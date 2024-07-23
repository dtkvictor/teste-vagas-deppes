<script lang="ts" setup>
    defineProps({
        id: {
            required: true,
            type: String
        }, 
        title: String,
    })
</script>
<template>
    <div class="offcanvas offcanvas-start" tabindex="-1" :id="id" :aria-labelledby="'offcanvas-' + id">
        <div class="offcanvas-header">
            <slot name="header"></slot>
            <h5 class="offcanvas-title" :id="'offcanvas-' + id" v-if="title">
                {{ title }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <slot/>
        </div>
    </div>
</template>